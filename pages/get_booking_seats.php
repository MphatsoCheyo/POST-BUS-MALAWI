<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Database connection
$servername = "localhost";
$username = "root";
$password = "secure";
$dbname = "bus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode([
        'error' => true,
        'message' => 'Connection failed: ' . $conn->connect_error
    ]));
}

// Get booking ID from URL
$booking_id = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : null;

if (!$booking_id) {
    die(json_encode([
        'error' => true,
        'message' => 'No booking ID provided'
    ]));
}

// Prepare SQL to get seats and total amount
$sql = "
    SELECT 
        GROUP_CONCAT(s.seat_number SEPARATOR ', ') AS selected_seats,
        bs.total_amount
    FROM 
        seat s
    JOIN 
        bookingsumma bs ON s.booking_id = bs.booking_id
    WHERE 
        s.booking_id = ?
    GROUP BY 
        bs.booking_id
";

// Prepare and execute statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Format total amount (assuming it's stored in decimal)
    $formatted_amount = 'MWK ' . number_format($row['total_amount'], 2);
    
    echo json_encode([
        'error' => false,
        'selected_seats' => explode(', ', $row['selected_seats']),
        'total_amount' => $formatted_amount
    ]);
} else {
    echo json_encode([
        'error' => true,
        'message' => 'No booking found'
    ]);
}

$stmt->close();
$conn->close();
?>