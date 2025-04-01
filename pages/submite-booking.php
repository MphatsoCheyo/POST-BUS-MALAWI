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

    // Check if the user exists
    $checkUserQuery = "SELECT user_id FROM user WHERE user_id = ?";
    $checkUserStmt = $conn->prepare($checkUserQuery);
    $checkUserStmt->bind_param("i", $user_id); // Bind as integer
    $checkUserStmt->execute();
    $checkUserStmt->store_result();

    if ($checkUserStmt->num_rows == 0) {
        echo json_encode(["success" => false, "message" => "User not found."]);
        exit();
    }

    $checkUserStmt->close();

    if (!empty($departure) && !empty($destination) && !empty($travel_date) && !empty($travel_time)) {
        // Include user_id in the INSERT query
        $stmt = $conn->prepare("INSERT INTO bookings (user_id, departure, destination, travel_date, travel_time) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $user_id, $departure, $destination, $travel_date, $travel_time);

        if ($stmt->execute()) {
            $_SESSION['booking_code'] = $stmt->insert_id; // Store booking_code in session

            // Redirect to seat selection page (seat.php)
            header("Location: seat.php?booking_code=" . $_SESSION['booking_code']);
            exit();
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
