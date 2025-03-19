<?php
session_start();
include 'db.php';

error_log('Processing seat selection request');

// Get raw input and decode JSON
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(["success" => false, "message" => "Invalid JSON data"]);
    exit;
}

// Validate session
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit;
}

// Validate booking_code
if (!isset($data['booking_code']) || empty($data['booking_code'])) {
    echo json_encode(["success" => false, "message" => "Missing booking ID"]);
    exit;
}

// Validate selected seats
if (!isset($data['selected_seats']) || !is_array($data['selected_seats']) || empty($data['selected_seats'])) {
    echo json_encode(["success" => false, "message" => "No seats selected"]);
    exit;
}

$booking_code = $data['booking_code'];
$selected_seats = $data['selected_seats'];
$user_id = $_SESSION['user_id'];
$seats_string = implode(",", $selected_seats);

// ✅ Step 1: Check if the booking code exists
$stmt = $conn->prepare("SELECT 1 FROM bookings WHERE booking_code = ? AND user_id = ?");
$stmt->bind_param("si", $booking_code, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["success" => false, "message" => "Booking code not found. Please start a new booking."]);
    exit;
}
$stmt->close();

// ✅ Step 2: Update the seats in the database
$stmt = $conn->prepare("UPDATE bookings SET selected_seats = ? WHERE booking_code = ? AND user_id = ?");
$stmt->bind_param("ssi", $seats_string, $booking_code, $user_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Seats selected successfully", "booking_code" => $booking_code]);
} else {
    echo json_encode(["success" => false, "message" => "Database error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
