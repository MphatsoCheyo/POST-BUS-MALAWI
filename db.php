<?php
$host = "localhost";
$user = "root"; // Change to your database username
$pass = "secure"; // Change to your database password
$dbname = "post_bus_malawi";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
