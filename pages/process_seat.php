<?php

header('Content-Type: application/json');

// Database configuration
$host = 'localhost';
$dbname = 'postbus';
$username = 'root';
$password = 'secure';

// Error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Create database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    // Get the raw POST data
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Validate input data
    if (!$data || !isset($data['booking_id'], $data['seats'], $data['total_amount'])) {
        throw new Exception('Invalid request data');
    }

    $bookingId = $data['booking_id'];
    $seats = $data['seats'];
    $totalAmount = $data['total_amount'];
    $currentDateTime = date('Y-m-d H:i:s');

    // Begin transaction
    $pdo->beginTransaction();

    // 1. Create booking summary
    $stmt = $pdo->prepare("
        INSERT INTO bookingsummary 
        (booking_id, total_amount, status, created_at, updated_at)
        VALUES (?, ?, 'pending', ?, ?)
    ");
    $stmt->execute([$bookingId, $totalAmount, $currentDateTime, $currentDateTime]);

    // 2. Reserve each seat
    $seatStmt = $pdo->prepare("
        UPDATE seats 
        SET status = 'reserved', 
            booking_id = ?,
            booked_at = ?
        WHERE seat_number = ? 
        AND status = 'available'
    ");

    $reservedSeats = [];
    foreach ($seats as $seat) {
        $seatStmt->execute([$bookingId, $currentDateTime, $seat]);
        
        if ($seatStmt->rowCount() === 0) {
            // Seat is no longer available
            throw new Exception("Seat $seat is no longer available");
        }
        
        $reservedSeats[] = $seat;
    }

    // If we got here, all seats were reserved successfully
    $pdo->commit();

    // Prepare response
    $response = [
        'success' => true,
        'message' => 'Seats reserved successfully',
        'booking_id' => $bookingId,
        'reserved_seats' => $reservedSeats,
        'total_amount' => $totalAmount,
        'redirect_url' => 'payment.php?booking_id=' . $bookingId
    ];

} catch (Exception $e) {
    // Roll back transaction if it was started
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }

    // Error response
    $response = [
        'success' => false,
        'message' => 'Booking failed: ' . $e->getMessage()
    ];
}

echo json_encode($response);
?>