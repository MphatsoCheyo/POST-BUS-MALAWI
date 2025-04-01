<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');


// Remove or replace the undefined function call//+
// If error logging is needed, consider using PHP's built-in error logging functions//+
error_reporting(E_ALL);//+
ini_set('display_errors', 1);//+
ini_set('log_errors', 1);//+
ini_set('error_log', 'error.log');//+

// Database connection
$servername = "localhost";
$username = "root";
$password = "secure";
$dbname = "bus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode([
        'error' => 'Database connection failed: ' . $conn->connect_error
    ]));
}

// Get POST data
$input = json_decode(file_get_contents('php://input'), true);

try {
    // Begin transaction
    $conn->begin_transaction();

    // Generate ticket number
    $ticketNumber = 'PBMW-' . sprintf('%06d', mt_rand(0, 999999));

    // Update bookingsumma status
    $update_booking_sql = "UPDATE bookingsumma SET payment_status = 'paid' WHERE booking_id = ?";
    $stmt = $conn->prepare($update_booking_sql);
    $stmt->bind_param("i", $input['bookingId']);
    $stmt->execute();
    $stmt->close();

    // Update payment details
    $update_payment_sql = "
        UPDATE payment_details 
        SET payment_status = ?, 
            payment_intent_id = ?, 
            ticket_number = ? 
        WHERE booking_id = ?
    ";
    $stmt = $conn->prepare($update_payment_sql);
    $stmt->bind_param("sssi", 
        $input['paymentStatus'], 
        $input['paymentIntentId'], 
        $ticketNumber, 
        $input['bookingId']
    );
    $stmt->execute();
    $stmt->close();

    // Update seat status
    $update_seat_sql = "UPDATE seat SET status = 'booked' WHERE booking_id = ?";
    $stmt = $conn->prepare($update_seat_sql);
    $stmt->bind_param("i", $input['bookingId']);
    $stmt->execute();
    $stmt->close();

    // Commit transaction
    $conn->commit();

    // Return ticket number
    echo json_encode([
        'ticketNumber' => $ticketNumber,
        'success' => true
    ]);

} catch (Exception $e) {
    // Rollback transaction in case of error
    $conn->rollback();

    echo json_encode([
        'error' => $e->getMessage()
    ]);
}

$conn->close();
?>