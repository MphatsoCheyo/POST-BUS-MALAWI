<?php
$page_name = 'payment';  // Set the current page name
include('../pages/header.php');
?>
</head>
<body>
    <div class="contaainer">
        <div class="hea">
            <button class="back-button" onclick="goBack()">
                &#8592; <span>Back</span>
            </button>
            <h2>Making Payment</h2>
            <p>Complete your bus ticket purchase</p>
        </div>

        <div class="order-summary">
            <h2>Order Summary</h2>
            <div class="summary-item">
                <span>Selected Seats:</span>
                <span id="selectedSeatsDisplay">Loading...</span>
            </div>
            <div class="summary-item">
                <span>Base Fare:</span>
                <span>MWK 35,000</span>
            </div>
            <div class="summary-item">
                <span>Booking Fee:</span>
                <span>MWK 2,500</span>
            </div>
            <div class="summary-item">
                <span>Tax:</span>
                <span>MWK 3,750</span>
            </div>
            <div class="summary-total">
                <span>Total:</span>
                <span id="totalAmountDisplay">Loading...</span>
            </div>
        </div>

        <div class="payment-options">
            <h2>Select Payment Method</h2>
            <div class="payment-methods">
                <div class="payment-method" onclick="selectPaymentMethod(this, 'card')">
                    <img src="images/credit-card-icon.png" alt="Credit Card">
                    <p>Credit/Debit Card</p>
                </div>
                <div class="payment-method" onclick="selectPaymentMethod(this, 'mobile')">
                    <img src="images/mobile-money-icon.png" alt="Mobile Money">
                    <p>Mobile Money</p>
                </div>
                <div class="payment-method" onclick="selectPaymentMethod(this, 'bank')">
                    <img src="images/bank-transfer-icon.png" alt="Bank Transfer">
                    <p>Bank Transfer</p>
                </div>
                <div class="payment-method" onclick="selectPaymentMethod(this, 'paychangu')">
                    <img src="../images/pachangu.jpg" alt="PayChangu">
                    <p>PayChangu</p>
                </div>
            </div>
        </div>

        <div class="payment-form" id="cardForm">
            <div class="form-group">
                <label for="cardName">Name on Card</label>
                <input type="text" id="cardName" placeholder="John Doe">
            </div>
            <div class="form-group">
                <label for="cardNumber">Card Number</label>
                <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="expiryDate">Expiry Date</label>
                    <input type="text" id="expiryDate" placeholder="MM/YY">
                </div>
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" placeholder="123">
                </div>
            </div>
        </div>

        <div class="payment-form" id="mobileForm" style="display: none;">
            <div class="form-group">
                <label for="mobileProvider">Select Provider</label>
                <select id="mobileProvider">
                    <option value="">Select Mobile Money Provider</option>
                    <option value="airtel">Airtel Money</option>
                    <option value="tnm">TNM Mpamba</option>
                </select>
            </div>
            <div class="form-group">
                <label for="mobileNumber">Mobile Number</label>
                <input type="text" id="mobileNumber" placeholder="0888 123 456">
            </div>
        </div>

        <div class="payment-form" id="bankForm" style="display: none;">
            <div class="form-group">
                <label for="bankName">Select Bank</label>
                <select id="bankName">
                    <option value="">Select Bank</option>
                    <option value="nbm">National Bank of Malawi</option>
                    <option value="standard">Standard Bank</option>
                    <option value="fmb">First Capital Bank</option>
                </select>
            </div>
            <div class="form-group">
                <label for="accountNumber">Account Number</label>
                <input type="text" id="accountNumber" placeholder="Account Number">
            </div>
        </div>

        <div class="payment-form" id="paychanguForm" style="display: none;">
            <div class="form-group">
                <label for="paychanguId">PayChangu ID</label>
                <input type="text" id="paychanguId" placeholder="Your PayChangu ID">
            </div>
            <div class="form-group">
                <label for="paychanguEmail">Email Address</label>
                <input type="email" id="paychanguEmail" placeholder="email@example.com">
            </div>
        </div>

        <div class="security-info">
            <i>🔒</i>
            <p>Your payment information is secured with 256-bit encryption. Post Bus Malawi and PayChangu ensure complete data confidentiality during processing.</p>
        </div>

        <button class="pay-button" onclick="processPayment()">Pay Now</button>

        <div class="paychang-badge">
            <p>Secured by</p>
            <img src="../images/pachangu.jpg" alt="PayChangu" class="changu">
        </div>
    </div>

    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
        <div class="loading-text">Processing your payment...</div>
    </div>

    <div class="success-message" id="successMessage">
        <div class="success-content">
            <div class="success-icon">✓</div>
            <h2>Payment Successful!</h2>
            <p>Your booking has been confirmed. A confirmation has been sent to your email and phone.</p>
            <button class="continue-button" onclick="redirectToConfirmation()">View Ticket</button>
        </div>
    </div>

    <?php
    include('../pages/footer.php');  // Include footer.php
    ?>
    
    <script src="../script/java.js"></script>
    <script src="../script/script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Load selected seats and total amount from local storage
            const selectedSeats = JSON.parse(localStorage.getItem('selectedSeats')) || [];
            const totalAmount = localStorage.getItem('totalAmount') || 'MWK 41,250';
            
            // Update the display
            document.getElementById('selectedSeatsDisplay').textContent = selectedSeats.join(', ');
            document.getElementById('totalAmountDisplay').textContent = totalAmount;
        });
        
        function selectPaymentMethod(element, method) {
            // Reset all payment methods
            const methods = document.querySelectorAll('.payment-method');
            methods.forEach(m => m.classList.remove('active'));
            
            // Hide all forms
            document.getElementById('cardForm').style.display = 'none';
            document.getElementById('mobileForm').style.display = 'none';
            document.getElementById('bankForm').style.display = 'none';
            document.getElementById('paychanguForm').style.display = 'none';
            
            // Activate selected method
            element.classList.add('active');
            
            // Show the appropriate form
            document.getElementById(method + 'Form').style.display = 'block';
        }
        
        function processPayment() {
            // Show loading overlay
            document.getElementById('loadingOverlay').style.display = 'flex';
            
            // Simulate payment processing (3 seconds)
            setTimeout(function() {
                // Hide loading overlay
                document.getElementById('loadingOverlay').style.display = 'none';
                
                // Show success message
                document.getElementById('successMessage').style.display = 'flex';
                
                // Store confirmation in local storage
                localStorage.setItem('paymentConfirmed', 'true');
                
                // Generate a ticket number and store it
                const ticketNumber = 'PBMW-' + Math.floor(Math.random() * 1000000);
                localStorage.setItem('ticketNumber', ticketNumber);
            }, 3000);
        }
        
        function redirectToConfirmation() {
            // Redirect to ticket confirmation page
            window.location.href = 'ticket-confirmation.php';
        }
        
        function goBack() {
            // Go back to seat selection page
            window.location.href = 'seat.php';
        }
        
        // Basic form validation for card numbers
        document.getElementById('cardNumber').addEventListener('input', function(e) {
            // Format card number with spaces after every 4 digits
            let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            let formattedValue = '';
            
            for (let i = 0; i < value.length; i++) {
                if (i > 0 && i % 4 === 0) {
                    formattedValue += ' ';
                }
                formattedValue += value[i];
            }
            
            e.target.value = formattedValue;
        });
        
        // Format expiry date
        document.getElementById('expiryDate').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            
            if (value.length > 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            
            e.target.value = value;
        });
    </script>
    <script src="../script/java.js"></script>
    <script src="../script/script.js"></script>
</body>
</html>