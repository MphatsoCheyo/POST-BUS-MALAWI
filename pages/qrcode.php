<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// echo "Booking code: " . $booking_code . "<br>";

$page_name = 'ticket';
// Initialize booking variable first thing
$booking_id = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;

// Now set the page name
$page_name = 'ticket';

// For debugging
// echo "Booking ID: " . ($booking_id > 0 ? $booking_id : "No booking ID provided") . "<br>";

// Database connection
$conn = new mysqli("localhost", "root", "secure", "bus");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables with default values
$ticketData = [
    'ticketId' => '',
    'route' => '',
    'date' => '',
    'departureTime' => '',
    'seats' => [],
    'amountPaid' => '',
    'passenger' => [
        'name' => '',
        'id' => '',
        'phone' => ''
    ]
];

// Fetch booking and user data from database
if ($booking_id > 0) {
    // First get the booking details and user info
    $sql = "SELECT b.booking_code, b.departure, b.destination, b.travel_date, b.travel_time,
                   u.name, u.email, u.phone, u.user_id
            FROM bookings b
            JOIN user u ON b.user_id = u.user_id
            WHERE b.booking_code = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Now get payment details separately
        $paymentSql = "SELECT amount, ticket_number 
                       FROM payment_details 
                       WHERE booking_id = ? 
                       LIMIT 1";
        $paymentStmt = $conn->prepare($paymentSql);
        $paymentStmt->bind_param("i", $booking_id);
        $paymentStmt->execute();
        $paymentResult = $paymentStmt->get_result();
        $paymentRow = $paymentResult->fetch_assoc();

        // ... rest of the code ...

        // Format departure time
        $departureTime = new DateTime($row['travel_time']);
        $formattedDepartureTime = $departureTime->format('h:i A');

        // Format the date
        $travelDate = new DateTime($row['travel_date']);
        $formattedDate = $travelDate->format('d F Y');

        // Format the amount (default to 0 if no payment record found)
        $amount = $paymentRow ? $paymentRow['amount'] : $row['total_amount']; // Fallback to bookingsumma amount
        $formattedAmount = 'MWK ' . number_format($amount, 2);

        // Generate route string
        $route = $row['departure'] . ' to ' . $row['destination'];

        // Fetch seat information - corrected to use booking_id from bookingsumma
        $seatsSql = "SELECT seat_number FROM seat WHERE booking_id = ? AND status = 'reserved'";
        $seatsStmt = $conn->prepare($seatsSql);
        $seatsStmt->bind_param("i", $booking_id);
        $seatsStmt->execute();
        $seatsResult = $seatsStmt->get_result();

        $seats = [];
        while ($seatRow = $seatsResult->fetch_assoc()) {
            $seats[] = $seatRow['seat_number'];
        }

        // Update ticket data
        $ticketData = [
            'ticketId' => $paymentRow ? $paymentRow['ticket_number'] : ('PBMW-' . $row['booking_code']),
            'route' => $route,
            'date' => $formattedDate,
            'departureTime' => $formattedDepartureTime,
            'seats' => $seats,
            'amountPaid' => $formattedAmount,
            'passenger' => [
                'name' => $row['name'],
                'id' => 'MAL' . $row['user_id'] . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT),
                'phone' => $row['phone']
            ]
        ];

        $seatsStmt->close();
        $paymentStmt->close();
    }

    $stmt->close();
}

// Close database connection
$conn->close();

// Convert PHP array to JSON for JavaScript
$ticketDataJson = json_encode($ticketData);
?>
<?php
$page_name = 'booking';  // Set the current page name
include('../pages/header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Post Bus Malawi Ticket</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 20px;
        }

        .heade {
            text-align: center;
            margin-bottom: 2rem;
        }

        .heade h2 {
            color: var(--primary-color);
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .heade p {
            color: #666;
            text-align: center;
        }

        .success-message {
            align-items: center;
            background-color: #e8f5e9;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .success-message i {
            background-color: var(--success-color);
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-style: normal;
        }

        .success-message p {
            color: #2e7d32;
        }

        .ticket-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 2rem;
            position: relative;
        }

        .ticket-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(to right, var(--primary-color), var(--info-color));
        }

        .ticket-header {
            padding: 1.5rem;
            border-bottom: 1px dashed #ddd;
            position: relative;
        }

        .ticket-header::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: -8px;
            width: 16px;
            height: 16px;
            background-color: #f5f5f5;
            border-radius: 50%;
            box-shadow: inset 0 0 0 1px #ddd;
        }

        .ticket-header::before {
            content: '';
            position: absolute;
            bottom: -8px;
            right: -8px;
            width: 16px;
            height: 16px;
            background-color: #f5f5f5;
            border-radius: 50%;
            box-shadow: inset 0 0 0 1px #ddd;
        }

        .ticket-header h2 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .ticket-header p {
            color: #666;
            font-size: 0.9rem;
        }

        .ticket-body {
            padding: 1.5rem;

            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .ticket-body {
                grid-template-columns: 1fr 1fr;
            }

            .qr-section {
                grid-column: 1 / -1;
                display: grid;
                grid-template-columns: 1fr 1fr;
                align-items: center;
            }
        }

        .ticket-info,
        .passenger-info {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .section-title {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background-color: var(--accent-color);
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #eee;
        }

        .label {
            color: #666;
            font-weight: 500;
        }

        .value {
            color: #333;
            font-weight: 600;
        }

        .qr-section {
            text-align: center;
            padding: 1.5rem;
            background-color: #f8f9fa;
            border-radius: 8px;
            margin-top: 1rem;
        }

        .qr-note {
            color: #666;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .qr-container {
            display: flex;
            justify-content: center;
            margin: 1rem 0;
        }

        .action-buttons {
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .action-button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .download-button {
            background-color: var(--primary-color);
            color: white;
        }

        .download-button:hover {
            background-color: #004494;
        }

        .validate-button {
            background-color: var(--secondary-color);
            color: white;
        }

        .validate-button:hover {
            background-color: #004494;
        }

        .action-button i {
            margin-right: 0.5rem;
            font-style: normal;
        }

        .delivery-options {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .delivery-options h2 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
        }

        .send-button {
            width: 100%;
            padding: 0.75rem;
            background-color: var(--info-color);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .send-button:hover {
            background-color: #004494;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            z-index: 1000;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 1rem;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .loading-text {
            color: white;
            font-weight: 500;
        }

        .validation-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .validation-content {
            background-color: white;
            border-radius: 12px;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .validation-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .validation-header i {
            background-color: var(--success-color);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-style: normal;
            font-size: 1.2rem;
        }

        .validation-header h2 {
            color: var(--success-color);
        }

        .validation-info p {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
        }

        .validation-info p:last-child {
            border-bottom: none;
        }

        .close-button {
            width: 100%;
            padding: 0.75rem;
            background-color: var(--dark-color);
            color: white;
            border: none;
            border-radius: 6px;
            margin-top: 1.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .close-button:hover {
            background-color: #23272b;
        }

        .notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: var(--dark-color);
            color: white;
            padding: 1rem;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: none;
            z-index: 1001;
            max-width: 300px;
        }

        /* Branding elements */
        .bus-icon {
            position: absolute;
            right: 1.5rem;
            top: 1.5rem;
            color: var(--primary-color);
            font-size: 1.5rem;
            opacity: 0.7;
        }

        .ticket-watermark {
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-size: 8rem;
            color: rgba(0, 0, 0, 0.03);
            font-weight: bold;
            pointer-events: none;
            line-height: 1;
            transform: rotate(-15deg);
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .action-buttons {
                grid-template-columns: 1fr;
            }

            .ticket-body {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="heade">
            <h2>E-Receipt & Ticket</h2>
            <p>Thank you for traveling with Post Bus Malawi</p>
        </div>

        <div class="success-message">
            <i>✓</i>
            <p>Your payment has been processed successfully. Your ticket is ready.</p>
        </div>

        <div class="ticket-card">
            <div class="ticket-header">
                <h2>Bus Ticket</h2>
                <p>Booking Reference: <span id="bookingReference">Loading...</span></p>
                <div class="bus-icon">🚌</div>
            </div>

            <div class="ticket-body">
                <div class="ticket-info">
                    <h3 class="section-title">Journey Details</h3>
                    <div class="info-row">
                        <span class="label">Route</span>
                        <span class="value" id="route">Loading...</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Date</span>
                        <span class="value" id="travelDate">Loading...</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Departure Time</span>
                        <span class="value" id="departureTime">Loading...</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Seat(s)</span>
                        <span class="value" id="seatNumbers">Loading...</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Amount Paid</span>
                        <span class="value" id="amountPaid">Loading...</span>
                    </div>
                </div>

                <div class="passenger-info">
                    <h3 class="section-title">Passenger Information</h3>
                    <div class="info-row">
                        <span class="label">Name</span>
                        <span class="value" id="passengerName">Loading...</span>
                    </div>
                    <!-- <div class="info-row">
                        <span class="label">ID Number</span>
                        <span class="value" id="passengerId">Loading...</span>
                    </div> -->
                    <div class="info-row">
                        <span class="label">Phone</span>
                        <span class="value" id="passengerPhone">Loading...</span>
                    </div>
                </div>

                <div class="qr-section">
                    <h3 class="section-title">Boarding Pass</h3>
                    <p class="qr-note">Present this QR code at the bus terminal for boarding</p>
                    <div class="qr-container" id="qrcode"></div>
                    <p class="qr-note">Ticket ID: <span id="ticketId">Loading...</span></p>
                </div>
            </div>

            <div class="ticket-watermark">PBM</div>
        </div>

        <div class="action-buttons">
            <button class="action-button download-button" onclick="downloadReceipt()">
                <i>⬇️</i> Download Ticket
            </button>
            <button class="action-button validate-button" onclick="validateTicket()">
                <i>✓</i> Validate Ticket
            </button>
        </div>

        <div class="delivery-options">
            <h2>Send Receipt</h2>
            <div class="form-group">
                <label for="emailInput">Email Address</label>
                <input type="email" id="emailInput" placeholder="your@email.com">
            </div>
            <button class="send-button" onclick="sendEmail()">Send via Email</button>
        </div>
    </div>

    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
        <div class="loading-text" id="loadingText">Processing your request...</div>
    </div>

    <div class="validation-modal" id="validationModal">
        <div class="validation-content">
            <div class="validation-header">
                <i>✓</i>
                <h2>Ticket Validated</h2>
            </div>
            <div class="validation-info">
                <p>
                    <span>Status:</span>
                    <span>Valid</span>
                </p>
                <p>
                    <span>Ticket ID:</span>
                    <span id="validationTicketId">Loading...</span>
                </p>
                <p>
                    <span>Passenger:</span>
                    <span id="validationPassenger">Loading...</span>
                </p>
                <p>
                    <span>Departure:</span>
                    <span id="validationDeparture">Loading...</span>
                </p>
                <p>
                    <span>Seat(s):</span>
                    <span id="validationSeats">Loading...</span>
                </p>
            </div>
            <button class="close-button" onclick="closeValidationModal()">Close</button>
        </div>
    </div>

    <div class="notification" id="notification"></div>
    <?php
    include('../pages/footer.php');  // Include footer.php
    ?>

    <!-- Include required libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <script>
        // Get ticket data from PHP
        let ticketData = <?php echo $ticketDataJson; ?>;

        document.addEventListener('DOMContentLoaded', function() {
            // Update the receipt UI with the loaded data
            updateReceiptUI();

            // Generate QR code with the ticket data
            generateQRCode(ticketData);
        });

        function updateReceiptUI() {
            // Update ticket information
            document.getElementById('bookingReference').textContent = ticketData.ticketId;
            document.getElementById('route').textContent = ticketData.route;
            document.getElementById('travelDate').textContent = ticketData.date;
            document.getElementById('departureTime').textContent = ticketData.departureTime;
            document.getElementById('seatNumbers').textContent = ticketData.seats.join(', ');
            document.getElementById('amountPaid').textContent = ticketData.amountPaid;
            document.getElementById('ticketId').textContent = ticketData.ticketId;

            // Update passenger information
            document.getElementById('passengerName').textContent = ticketData.passenger.name;
            document.getElementById('passengerPhone').textContent = ticketData.passenger.phone;

            // Update validation modal information
            document.getElementById('validationTicketId').textContent = ticketData.ticketId;
            document.getElementById('validationPassenger').textContent = ticketData.passenger.name;
            document.getElementById('validationDeparture').textContent = `${ticketData.date}, ${ticketData.departureTime}`;
            document.getElementById('validationSeats').textContent = ticketData.seats.join(', ');
        }

        function generateQRCode(data) {
            if (!data || !data.ticketId) {
                console.error("Invalid ticket data for QR generation");
                return;
            }

            // Use only essential data to avoid QR code overflow
            const qrData = JSON.stringify({
                ticketId: data.ticketId,
                verifyUrl: `https://postbusmalawi.com/verify-ticket.php?ticketId=${data.ticketId}`
            });

            // Clear previous QR code
            document.getElementById('qrcode').innerHTML = '';

            // Generate QR code
            new QRCode(document.getElementById("qrcode"), {
                text: qrData,
                width: 150,
                height: 150,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

            console.log("Generated QR Code with data:", qrData);
        }



        function sendEmail() {
            const email = document.getElementById('emailInput').value;
            if (!email) {
                showNotification('Please enter an email address');
                return;
            }

            // Show loading overlay
            document.getElementById('loadingOverlay').style.display = 'flex';
            document.getElementById('loadingText').textContent = 'Sending receipt to your email...';

            // Send AJAX request to server
            fetch('email.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        email: email,
                        ticketId: ticketData.ticketId
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    // Hide loading overlay
                    document.getElementById('loadingOverlay').style.display = 'none';

                    // Show notification
                    showNotification(data.message || 'Receipt sent to ' + email);

                    // Clear input
                    document.getElementById('emailInput').value = '';
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('loadingOverlay').style.display = 'none';
                    showNotification('Error sending email: ' + error.message);
                });
        }

        function downloadReceipt() {
            // Show loading overlay
            document.getElementById('loadingOverlay').style.display = 'flex';
            document.getElementById('loadingText').textContent = 'Preparing your ticket image...';

            // Use html2canvas to capture the receipt card as an image
            html2canvas(document.querySelector('.ticket-card')).then(canvas => {
                // Convert canvas to image data URL
                const imageData = canvas.toDataURL('image/png');

                // Create a temporary link to download the image
                const link = document.createElement('a');
                link.href = imageData;
                link.download = 'PostBusMalawi_Ticket_' + ticketData.ticketId + '.png';

                // Trigger the download
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                // Hide loading overlay
                document.getElementById('loadingOverlay').style.display = 'none';

                // Show notification
                showNotification('Ticket image downloaded successfully');
            }).catch(error => {
                console.error('Error generating image:', error);
                document.getElementById('loadingOverlay').style.display = 'none';
                showNotification('Error generating ticket image: ' + error.message);
            });
        }

        function validateTicket() {
            // Show loading overlay
            document.getElementById('loadingOverlay').style.display = 'flex';
            document.getElementById('loadingText').textContent = 'Validating ticket...';

            // Send AJAX request to server to validate the ticket
            fetch('validate.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        ticketId: ticketData.ticketId
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    // Hide loading overlay
                    document.getElementById('loadingOverlay').style.display = 'none';

                    // Show validation modal
                    document.getElementById('validationModal').style.display = 'flex';
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('loadingOverlay').style.display = 'none';
                    showNotification('Error validating ticket: ' + error.message);
                });
        }

        function closeValidationModal() {
            document.getElementById('validationModal').style.display = 'none';
        }

        function showNotification(message) {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.style.display = 'block';

            // Hide notification after 3 seconds
            setTimeout(function() {
                notification.style.display = 'none';
            }, 3000);
        }
        console.log('Ticket data:', ticketData);
    </script>
</body>

</html>