<?php
// login.php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', 'secure', 'post_bus_malawi');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a statement
    $sql = "SELECT id, name, password_hash FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Ensure 'password_hash' exists in the fetched row
        if (!isset($user['password_hash'])) {
            die("Error: Password column not found in database.");
        }

        // Verify the password
        if (password_verify($password, $user['password_hash'])) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            // Redirect to dashboard
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with that email!";
    }

    // Close resources
    $stmt->close();
    $conn->close();
}
?>
