<?php
$page_name = 'qrcode page';  // Set the current page name
include('../pages/header.php');
?>
<style>
        /* Global Styles */
        
        
    </style>
</head>
<body>
    <div class="containeryy">
        <!-- Butterfly Animation Container -->
        <div class="butterflies-container">
            <div class="butterfly butterfly1"></div>
            <div class="butterfly butterfly2"></div>
            <div class="butterfly butterfly3"></div>
            <div class="butterfly butterfly4"></div>
            <div class="butterfly butterfly5"></div>
        </div>
        
        <div class="head">
            <h2>E-Receipt & Ticket</h2>
            <p>Thank you for traveling with Post Bus Malawi</p>
        </div>

        <div class="success-message">
            <i>✓</i>
            <p>Your payment has been processed successfully. Your ticket is ready.</p>
        </div>

        <div class="receipt-card">
            <div class="receipt-header">
                <h2>Bus Ticket</h2>
                <p>Booking Reference: <span id="bookingReference">Loading...</span></p>
            </div>
            
            <div class="receipt-body">
                <div class="ticket-info">
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
                        <span class="label">Arrival Time</span>
                        <span class="value" id="arrivalTime">Loading...</span>
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
                    <div class="info-row">
                        <span class="label">ID Number</span>
                        <span class="value" id="passengerId">Loading...</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Phone</span>
                        <span class="value" id="passengerPhone">Loading...</span>
                    </div>
                </div>
                
                <div class="qr-section">
                    <h3 class="section-title">Boarding Pass</h3>
                    <p class="qr-note">Scan this QR code at the bus terminal for boarding</p>
                    <div class="qr-container" id="qrcode"></div>
                    <p class="qr-note">Ticket ID: <span id="ticketId">Loading...</span></p>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <button class="action-button download-button" onclick="downloadReceipt()">
                <i>⬇️</i> Download PDF
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
            
            <div class="form-group" style="margin-top: 20px;">
                <label for="phoneInput">Phone Number</label>
                <input type="tel" id="phoneInput" placeholder="+265 88 123 4567">
            </div>
            <button class="send-button" onclick="sendSMS()">Send via SMS</button>
        </div>
    </div>

    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
        <div class="loading-text" id="loadingText">Sending receipt to your email...</div>
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

    <script>
        // Initialize empty ticket data structure
        let ticketData = {
            ticketId: '',
            route: '',
            date: '',
            departureTime: '',
            arrivalTime: '',
            seats: [],
            amountPaid: '',
            passenger: {
                name: '',
                id: '',
                phone: ''
            }
        };
        
        document.addEventListener('DOMContentLoaded', function() {
            // Load data from localStorage (set by the booking process)
            loadTicketData();
            
            // Update the receipt UI with the loaded data
            updateReceiptUI();
            
            // Generate QR code with the ticket data
            generateQRCode(ticketData);
            
            // Start butterfly animation with delay
            setTimeout(startRandomButterflies, 3000);
        });
        
        function loadTicketData() {
            // Get selected seats
            ticketData.seats = JSON.parse(localStorage.getItem('selectedSeats')) || [];
            
            // Get route information
            ticketData.route = localStorage.getItem('selectedRoute') || 'Lilongwe to Blantyre';
            
            // Get date and time information
            ticketData.date = localStorage.getItem('travelDate') || '12 Mar 2025';
            ticketData.departureTime = localStorage.getItem('departureTime') || '08:30 AM';
            ticketData.arrivalTime = localStorage.getItem('arrivalTime') || '12:45 PM';
            
            // Get payment information
            ticketData.amountPaid = localStorage.getItem('totalAmount') || 'MWK 41,250';
            
            // Get ticket ID/reference number
            ticketData.ticketId = localStorage.getItem('ticketNumber') || generateTicketId();
            
            // Get passenger information
            ticketData.passenger.name = localStorage.getItem('passengerName') || 'John Banda';
            ticketData.passenger.id = localStorage.getItem('passengerId') || 'MAL12345678';
            ticketData.passenger.phone = localStorage.getItem('passengerPhone') || '+265 88 123 4567';
            
            // If no seats are found, use default seats
            if (ticketData.seats.length === 0) {
                ticketData.seats = ['4B', '4C'];
            }
        }
        
        function generateTicketId() {
            // Generate a random ticket ID if one doesn't exist
            const randomNum = Math.floor(100000 + Math.random() * 900000);
            const ticketId = 'PBMW-' + randomNum;
            
            // Save to localStorage for future reference
            localStorage.setItem('ticketNumber', ticketId);
            
            return ticketId;
        }
        
        function updateReceiptUI() {
            // Update ticket information
            document.getElementById('bookingReference').textContent = ticketData.ticketId;
            document.getElementById('route').textContent = ticketData.route;
            document.getElementById('travelDate').textContent = ticketData.date;
            document.getElementById('departureTime').textContent = ticketData.departureTime;
            document.getElementById('arrivalTime').textContent = ticketData.arrivalTime;
            document.getElementById('seatNumbers').textContent = ticketData.seats.join(', ');
            document.getElementById('amountPaid').textContent = ticketData.amountPaid;
            document.getElementById('ticketId').textContent = ticketData.ticketId;
            
            // Update passenger information
            document.getElementById('passengerName').textContent = ticketData.passenger.name;
            document.getElementById('passengerId').textContent = ticketData.passenger.id;
            document.getElementById('passengerPhone').textContent = ticketData.passenger.phone;
            
            // Update validation modal information
            document.getElementById('validationTicketId').textContent = ticketData.ticketId;
            document.getElementById('validationPassenger').textContent = ticketData.passenger.name;
            document.getElementById('validationDeparture').textContent = `${ticketData.date}, ${ticketData.departureTime}`;
            document.getElementById('validationSeats').textContent = ticketData.seats.join(', ');
        }
        
        function generateQRCode(data) {
            // Create a JSON string from the ticket data
            const qrData = JSON.stringify({
                ticketId: data.ticketId,
                seats: data.seats,
                route: data.route,
                date: data.date,
                departureTime: data.departureTime,
                passengerName: data.passenger.name
            });
            
            // Clear existing QR code if any
            document.getElementById('qrcode').innerHTML = '';
            
            // Generate QR code
            new QRCode(document.getElementById("qrcode"), {
                text: qrData,
                width: 128,
                height: 128,
                colorDark: "#2B6CB0",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
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
            
            // Simulate sending email (3 seconds)
            setTimeout(function() {
                // Hide loading overlay
                document.getElementById('loadingOverlay').style.display = 'none';
                
                // Show notification
                showNotification('Receipt sent to ' + email);
                
                // Clear input
                document.getElementById('emailInput').value = '';
                
                // Create celebration butterflies
                for (let i = 0; i < 5; i++) {
                    setTimeout(createRandomButterfly, i * 300);
                }
            }, 3000);
        }
        
        function sendSMS() {
            const phone = document.getElementById('phoneInput').value;
            if (!phone) {
                showNotification('Please enter a phone number');
                return;
            }
            
            // Show loading overlay
            document.getElementById('loadingOverlay').style.display = 'flex';
            document.getElementById('loadingText').textContent = 'Sending receipt via SMS...';
            
            // Simulate sending SMS (3 seconds)
            setTimeout(function() {
                // Hide loading overlay
                document.getElementById('loadingOverlay').style.display = 'none';
                
                // Show notification
                showNotification('Receipt sent to ' + phone);
                
                // Clear input
                document.getElementById('phoneInput').value = '';
                
                // Create celebration butterflies
                for (let i = 0; i < 5; i++) {
                    setTimeout(createRandomButterfly, i * 300);
                }
            }, 3000);
        }
        
        function downloadReceipt() {
            // Show loading overlay
            document.getElementById('loadingOverlay').style.display = 'flex';
            document.getElementById('loadingText').textContent = 'Preparing your receipt...';
            
            // Simulate download (2 seconds)
            setTimeout(function() {
                // Hide loading overlay
                document.getElementById('loadingOverlay').style.display = 'none';
                
                // Show notification
                showNotification('Receipt downloaded successfully');
                
                // Create celebration butterflies
                for (let i = 0; i < 5; i++) {
                    setTimeout(createRandomButterfly, i * 300);
                }
                
                // In a real implementation, this would trigger a PDF download
                // For now, we'll just simulate it
                const link = document.createElement('a');
                link.href = '#';
                link.download = 'PostBusMalawi_Receipt_' + ticketData.ticketId + '.pdf';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }, 2000);
        }
        
        function validateTicket() {
            // Show loading overlay
            document.getElementById('loadingOverlay').style.display = 'flex';
            document.getElementById('loadingText').textContent = 'Validating ticket...';
            
            // Simulate ticket validation (2 seconds)
            setTimeout(function() {
                // Hide loading overlay
                document.getElementById('loadingOverlay').style.display = 'none';
                
                // Show validation modal
                document.getElementById('validationModal').style.display = 'flex';
                
                // Create celebration butterflies
                for (let i = 0; i < 10; i++) {
                    setTimeout(createRandomButterfly, i * 300);
                }
            }, 2000);
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
        
        // Butterfly Animation Functions
        function createRandomButterfly() {
            const container = document.querySelector('.butterflies-container');
            const butterfly = document.createElement('div');
            
            // Random vertical position
            const verticalPos = Math.random() * 100;
            
            // Random flight duration (20-35s)
            const duration = 20 + Math.random() * 15;
            
            // Random hue (0-360 degrees)
            const hue = Math.floor(Math.random() * 360);
            
            // Random size (0.6-1.0)
            const size = 0.6 + Math.random() * 0.4;
            
            // Apply styles
            butterfly.className = 'butterfly';
            butterfly.style.setProperty('--fly-duration', `${duration}s`);
            butterfly.style.setProperty('--hue', `${hue}deg`);
            butterfly.style.top = `${verticalPos}%`;
            butterfly.style.transform = `scale(${size})`;
            
            // Add to container
            container.appendChild(butterfly);
            
            // Remove after animation completes
            setTimeout(() => {
                if (container.contains(butterfly)) {
                    container.removeChild(butterfly);
                }
            }, duration * 1000);
        }
        
        // Create random butterflies periodically
        function startRandomButterflies() {
            // Initially create a few butterflies
            for (let i = 0; i < 3; i++) {
                setTimeout(createRandomButterfly, i * 2000);
            }
            
            // Continue creating butterflies periodically
            setInterval(createRandomButterfly, 5000);
        }
    </script>
    <script src="../script/java.js"></script>
    <script src="../script/script.js"></script>
</body>
    </html>
    