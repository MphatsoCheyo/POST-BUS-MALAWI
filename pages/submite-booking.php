<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "Please log in first."]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departure = $_POST['departure'];
    $destination = $_POST['destination'];
    $travel_date = $_POST['travel_date'];
    $travel_time = $_POST['travel_time'];
    $user_id = $_SESSION['user_id']; // Get logged-in user ID

    if (!empty($departure) && !empty($destination) && !empty($travel_date) && !empty($travel_time)) {
        $stmt = $conn->prepare("INSERT INTO bookings (user_id, departure, destination, travel_date, travel_time) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $user_id, $departure, $destination, $travel_date, $travel_time);

        if ($stmt->execute()) {
            $_SESSION['booking_id'] = $stmt->insert_id; // Store booking ID in session
            
            // Redirect to seat selection page (seat.php)
            header("Location: seat.php?booking_id=" . $_SESSION['booking_id']);
            exit();  // Make sure to exit after redirection
        } else {
            echo json_encode(["success" => false, "message" => "Database error: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "All fields are required."]);
    }
}

$conn->close();
?>
