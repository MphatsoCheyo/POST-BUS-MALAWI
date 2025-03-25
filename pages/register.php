<?php
// Start the session
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input values and sanitize them
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $date_of_birth = htmlspecialchars(trim($_POST['date_of_birth']));
    $password = $_POST['password']; // Raw input for hashing

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Database connection
    $conn = new mysqli('localhost', 'root', 'secure', 'bus');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the email already exists
    $sql_check = "SELECT * FROM user WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        echo "Email already exists!";
    } else {
        // Prepare an insert statement
        $sql = "INSERT INTO user (name, email, phone, date_of_birth, password_hash) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Check if the statement was prepared successfully
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param("sssss", $name, $email, $phone, $date_of_birth, $hashed_password);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Registration successful!";
            // Redirect to login page after successful registration
            header('Location: login.php');
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Close the connection
    $conn->close();
}
?>
