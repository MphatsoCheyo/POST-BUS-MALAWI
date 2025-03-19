<?php
$servername = "localhost";
$username = "root"; // Change if using another user
$password = "secure"; // Set your database password
$dbname = "post_bus_malawi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
