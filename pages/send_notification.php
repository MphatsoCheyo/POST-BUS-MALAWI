<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Required headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// PHPMailer integration
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Make sure autoload path is correct
require '../MaillerPHP/vendor/autoload.php';

// Database connection details
$servername = "localhost";
$username = "root";
$password = "secure";  // Database password
$dbname = "bus";  // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode([
        'success' => false, 
        'message' => 'Database connection failed: ' . $conn->connect_error
    ]);
    exit;
}

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);

// Get and validate email - Remove hardcoded email
$email = isset($data['email']) ? filter_var($data['email'], FILTER_VALIDATE_EMAIL) : null;
$bus_route = isset($data['bus_route']) ? htmlspecialchars(strip_tags($data['bus_route'])) : '';
$bus_id = isset($data['bus_id']) ? htmlspecialchars(strip_tags($data['bus_id'])) : '';

$response = [];

if (!$email) {
    $response = [
        'success' => false,
        'message' => 'Invalid email address'
    ];
} else {
    try {
        // Check if email already exists for this route
        $check_stmt = $conn->prepare("SELECT id FROM email_subscriptions WHERE email = ? AND bus_route = ? LIMIT 1");
        $check_stmt->bind_param("ss", $email, $bus_route);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $response = [
                'success' => false,
                'message' => 'You are already subscribed to this route'
            ];
        } else {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO email_subscriptions (email, bus_route, bus_id, subscribed_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("sss", $email, $bus_route, $bus_id);

            if ($stmt->execute()) {
                // Send confirmation email
                try {
                    $mail = new PHPMailer(true);

                    // Server settings
                    $mail->SMTPDebug = 0; // Turn off debug output for production
                    $mail->isSMTP();
                    $mail->Host = 'smtp.useplunk.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'plunk'; // Plunk username
                    $mail->Password = 'sk_23ad8d96bf2636734d960ffc073e8c28d36ac7f88e46af52'; // Plunk API key
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    // Recipients - using the same address for from as authorized in Plunk
                    $mail->setFrom('no-reply@yourdomain.com', 'Bus Tracking System'); // Replace with a domain you've verified in Plunk
                    $mail->addAddress($email); // Send to the subscriber's email
                    
                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = "Bus Route Notification: $bus_route";
                    $mail->Body = "
                        <html>
                        <head>
                            <title>Bus Tracking Notification</title>
                        </head>
                        <body>
                            <h2>Bus Route Notification Subscription</h2>
                            <p>Thank you for subscribing to notifications for the following bus route:</p>
                            <p><strong>Route:</strong> $bus_route</p>
                            <p><strong>Route ID:</strong> $bus_id</p>
                            <p>You will receive updates about this bus route including delays, changes, and special notices.</p>
                            <p>Thank you for using our service!</p>
                        </body>
                        </html>
                    ";
                    $mail->AltBody = "Thank you for subscribing to notifications for $bus_route (ID: $bus_id)";

                    $mail->send();
                    
                    $response = [
                        'success' => true,
                        'message' => 'Successfully subscribed to bus route notifications'
                    ];
                } catch (Exception $e) {
                    // Email failed, but database insertion was successful
                    // Add more detailed error logging
                    error_log('Mailer Error: ' . $mail->ErrorInfo);
                    
                    $response = [
                        'success' => true,
                        'message' => 'Subscribed successfully, but confirmation email could not be sent. Please contact support.'
                    ];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed to subscribe. Database error: ' . $stmt->error
                ];
            }

            $stmt->close();
        }

        $check_stmt->close();
    } catch (Exception $e) {
        error_log('Subscription Error: ' . $e->getMessage());
        $response = [
            'success' => false,
            'message' => 'An error occurred: ' . $e->getMessage()
        ];
    }
}

$conn->close();

echo json_encode($response);
?>