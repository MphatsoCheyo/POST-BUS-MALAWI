<?php
// api/send_ticket_email.php
header('Content-Type: application/json');

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);
$email = isset($input['email']) ? $input['email'] : '';
$ticketId = isset($input['ticketId']) ? $input['ticketId'] : '';

// Validate input
if (empty($email) || empty($ticketId)) {
    echo json_encode(['success' => false, 'message' => 'Email and ticket ID are required']);
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "secure", "bus");

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

// Get ticket information
$sql = "SELECT b.booking_code, b.departure, b.destination, b.travel_date, b.travel_time,
               u.name, u.email, u.phone, 
               p.amount, p.ticket_number
        FROM payment_details p
        JOIN bookings b ON p.booking_id = b.booking_code
        JOIN user u ON b.user_id = u.user_id
        WHERE p.ticket_number = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $ticketId);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Generate ticket email content
    $emailSubject = "Your Post Bus Malawi E-Ticket: " . $ticketId;
    
    // Build email HTML body
    $emailBody = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; }
            .ticket { border: 1px solid #ddd; padding: 20px; max-width: 600px; margin: 0 auto; }
            .header { background-color: #2B6CB0; color: white; padding: 10px; text-align: center; }
            .info-row { display: flex; margin: 5px 0; border-bottom: 1px solid #eee; padding: 5px 0; }
            .label { font-weight: bold; width: 150px; }
            .value { flex: 1; }
            .qr-note { text-align: center; margin: 10px 0; }
            .footer { background-color: #f5f5f5; padding: 10px; text-align: center; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class='ticket'>
            <div class='header'>
                <h2>Post Bus Malawi - E-Ticket</h2>
            </div>
            
            <p>Dear {$row['name']},</p>
            <p>Thank you for choosing Post Bus Malawi. Your ticket details are below:</p>
            
            <div class='ticket-info'>
                <div class='info-row'>
                    <span class='label'>Booking Reference:</span>
                    <span class='value'>$ticketId</span>
                </div>
                <div class='info-row'>
                    <span class='label'>Route:</span>
                    <span class='value'>{$row['departure']} to {$row['destination']}</span>
                </div>
                <div class='info-row'>
                    <span class='label'>Date:</span>
                    <span class='value'>" . date('d F Y', strtotime($row['travel_date'])) . "</span>
                </div>
                <div class='info-row'>
                    <span class='label'>Departure Time:</span>
                    <span class='value'>" . date('h:i A', strtotime($row['travel_time'])) . "</span>
                </div>
            </div>
            
            <p class='qr-note'>Please present this email or your ticket QR code at the bus terminal.</p>
            
            <div class='footer'>
                <p>For assistance, contact us at help@postbusmalawi.com or call +265 1700 800</p>
            </div>
        </div>
    </body>
    </html>
    ";
    
    // Email headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: tickets@postbusmalawi.com" . "\r\n";
    
    // Send email
    $mailSent = mail($email, $emailSubject, $emailBody, $headers);
    
    if ($mailSent) {
        echo json_encode(['success' => true, 'message' => 'E-Ticket has been sent to ' . $email]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send email']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Ticket not found']);
}

$stmt->close();
$conn->close();
?>