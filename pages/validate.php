<?php
// api/validate_ticket.php
header('Content-Type: application/json');

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);
$ticketId = isset($input['ticketId']) ? trim($input['ticketId']) : '';

// Validate input
if (empty($ticketId)) {
    echo json_encode(['success' => false, 'message' => 'Ticket ID is required']);
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "secure", "bus");

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

// Fetch ticket information along with booking and user details
$sql = "SELECT 
            b.booking_code, b.departure, b.destination, b.travel_date, b.travel_time,
            u.name, u.email, u.phone, 
            p.amount, p.ticket_number, p.payment_status, p.booking_id
        FROM payment_details p
        JOIN bookingsumma bs ON p.booking_id = bs.booking_id
        JOIN bookings b ON b.booking_code = bs.booking_id
        JOIN user u ON b.user_id = u.user_id
        WHERE p.ticket_number = ? 
        LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $ticketId);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Verify if payment was successful
    if ($row['payment_status'] === 'succeeded') {
        // Get seat details based on the correct booking ID
        $seatsSql = "SELECT seat_number FROM seat WHERE booking_id = ? AND status IN ('reserved', 'booked')";
        $seatsStmt = $conn->prepare($seatsSql);
        $seatsStmt->bind_param("i", $row['booking_id']);
        $seatsStmt->execute();
        $seatsResult = $seatsStmt->get_result();
        
        $seats = [];
        while ($seatRow = $seatsResult->fetch_assoc()) {
            $seats[] = $seatRow['seat_number'];
        }

        // Format departure time and date
        $departureTime = date('h:i A', strtotime($row['travel_time']));
        $travelDate = date('d F Y', strtotime($row['travel_date']));
        
        // Response
        $response = [
            'success' => true,
            'status' => 'valid',
            'ticketId' => $row['ticket_number'],
            'passengerName' => $row['name'],
            'departure' => $travelDate . ', ' . $departureTime,
            'route' => $row['departure'] . ' to ' . $row['destination'],
            'seats' => !empty($seats) ? implode(', ', $seats) : 'No seat assigned',
            'message' => 'Ticket is valid'
        ];
    } else {
        $response = [
            'success' => false,
            'status' => 'invalid',
            'message' => 'Payment for this ticket has not been completed'
        ];
    }
} else {
    $response = [
        'success' => false,
        'status' => 'invalid',
        'message' => 'Ticket not found'
    ];
}

// Close statements and connection
$stmt->close();
$seatsStmt->close();
$conn->close();

// Output JSON response
echo json_encode($response);
?>
