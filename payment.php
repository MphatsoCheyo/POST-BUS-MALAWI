<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Post Bus Malawi</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
    

        
        .app{
            width: 60%;
            margin: 0 auto;
            background-color: white;
            height: auto;
            position: relative;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .page {
            display: none;
            padding: 20px;
        }
        
        .page.active {
            display: block;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        select, input, button {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
        }
        
        .button {
            background-color: #e60000;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        button:hover {
            background-color: #cc0000;
        }
        
        .route-map {
            background-color: #f9f9f9;
            border-radius: 6px;
            height: 200px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            position: relative;
            overflow: hidden;
        }
        
        .map-placeholder {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #999;
            text-align: center;
        }
        
        .map-placeholder i {
            font-size: 40px;
            margin-bottom: 10px;
            display: block;
        }
        
        .date-time-container {
            display: flex;
            gap: 10px;
        }
        
        .date-time-container .form-group {
            flex: 1;
        }
        
        .seat-layout {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-top: 20px;
            max-width: 300px;
            margin: 0 auto;
        }
        
        .seat {
            aspect-ratio: 1;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            background-color: #f9f9f9;
        }
        
        .seat.selected {
            background-color: #e60000;
            color: white;
            border-color: #e60000;
        }
        
        .seat.unavailable {
            background-color: #ddd;
            color: #999;
            cursor: not-allowed;
        }
        
        .seat-info {
            display: flex;
            justify-content: center;
            margin: 20px 0;
            gap: 20px;
        }
        
        .seat-info div {
            display: flex;
            align-items: center;
            font-size: 14px;
        }
        
        .seat-info .indicator {
            width: 15px;
            height: 15px;
            border-radius: 3px;
            margin-right: 5px;
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        
        .summary-item:last-child {
            border-bottom: none;
        }
        
        .total {
            font-weight: bold;
            font-size: 18px;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 2px solid #eee;
        }
        
        .payment-methods {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .payment-method {
            background: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
        }

        .payment-method:hover {
            transform: scale(1.05);
        }

        .payment-method img {
            width: 120px;
            height: 80px;
            border-radius: 5px;
        }

        #payment-info {
            display: none;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            padding: 10px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
        }

        #visa-form {
            display: none; /* Initially hidden */
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 16px;
            font-weight: bold;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            color: #333;
            background-color: #fafafa;
        }

        .form-group input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .date-time-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .date-time-container .form-group {
            width: 48%;
        }

        .form-group input::placeholder {
            color: #aaa;
        }

        .form-group input[type="password"] {
            letter-spacing: 2px;
        }

        /* Button styling */
        .form-group button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-group button:hover {
            background-color: #45a049;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            #visa-form {
                padding: 20px;
            }

            .date-time-container {
                flex-direction: column;
            }

            .date-time-container .form-group {
                width: 100%;
            }
        }
        .security-note {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin: 20px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .security-note i {
            margin-right: 5px;
        }
        
        .ticket {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin-top: 20px;
        }
        
        .qr-code {
            width: 200px;
            height: 200px;
            background-color: white;
            border: 1px solid #ddd;
            margin: 20px auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .ticket-details {
            text-align: left;
            margin: 20px 0;
        }
        
        .ticket-details div {
            margin-bottom: 5px;
        }
        
        .scanner-area {
            width: 100%;
            background-color: #f9f9f9;
            border: 2px dashed #ddd;
            border-radius: 10px;
            height: 250px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .scanner-area i {
            font-size: 40px;
            margin-bottom: 10px;
            color: #999;
        }
        
        .scan-result {
            padding: 15px;
            background-color: #f0f8ff;
            border-radius: 6px;
            margin-top: 10px;
            display: none;
        }
        
        .loading-spinner {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top: 4px solid #e60000;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
            display: none;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <header>
    <button class="logout-btn" onclick="logout()" title="Logout">
            <i class="fas fa-sign-out-alt"></i>
        </button>
        <div class="hamburger" onclick="toggleNav()">
            <i class="fas fa-bars"></i>
        </div>
        <img src="m.webp" alt="Post Bus Malawi Logo" class="logo">
    </header>
    
    <div class="nav-drawer" id="navDrawer">
    <a href="index.php" class="nav-item"><i class="fas fa-home"></i> Home</a>
        <a href="booking.php" class="nav-item"><i class="fas fa-ticket-alt"></i> Book a Ticket</a>
        <a href="schedule.php" class="nav-item"><i class="fas fa-clock"></i> Check Schedule</a>
        <a href="#" class="nav-item"><i class="fas fa-bus"></i> Track Bus</a>
        <a href="payment.php" class="nav-item"><i class="fas fa-credit-card"></i> Payment Options</a>
        <a href="#" class="nav-item"><i class="fas fa-calendar-check"></i> Manage Bookings</a>
        <a href="#" class="nav-item"><i class="fas fa-tag"></i> View Fares</a>
        <a href="#" class="nav-item"><i class="fas fa-percent"></i> View Promotions</a>
        <a href="#" class="nav-item"><i class="fas fa-headset"></i> Customer Support</a>
        <a href="#" class="nav-item"><i class="fas fa-user"></i> User Profile</a>
        <a href="#" class="nav-item"><i class="fas fa-history"></i> Travel History</a>
        <a href="#" class="nav-item"><i class="fas fa-route"></i> Frequent Routes</a>
        <a href="#" class="nav-item"><i class="fas fa-star"></i> Feedback & Ratings</a>
    </div>


<body>
    <div class="app">
        
        <!-- Route Selection Page -->
    <div class="page active" id="route-page">
    <h2>Book Your Journey</h2>
    <p style="margin-bottom: 20px;">Select your route, date, and time</p>
    
    <div class="route-map">
        <div class="map-placeholder" id="map" style="height: 400px;">
            <!-- Leaflet map will be rendered here -->
        </div>
    </div>
         <!-- <div id="map"></div> -->
    <div class="form-group">
        <label for="departure">Departure Location</label>
        <select id="departure">
            <option value="">Select departure location</option>
            <option value="lilongwe">Lilongwe</option>
            <option value="blantyre">Blantyre</option>
            <option value="mzuzu">Mzuzu</option>
            <option value="zomba">Zomba</option>
            <option value="mangochi">Mangochi</option>
        </select>
    </div>

    <div class="form-group">
        <label for="destination">Destination</label>
        <select id="destination">
            <option value="">Select destination</option>
            <option value="lilongwe">Lilongwe</option>
            <option value="blantyre">Blantyre</option>
            <option value="mzuzu">Mzuzu</option>
            <option value="zomba">Zomba</option>
            <option value="mangochi">Mangochi</option>
        </select>
    </div>
</div>
            <div class="date-time-container">
                <div class="form-group">
                    <label for="travel-date">Travel Date</label>
                    <input type="date" id="travel-date">
                </div>
                
                <div class="form-group">
                    <label for="travel-time">Departure Time</label>
                    <select id="travel-time">
                        <option value="">Select time</option>
                        <option value="06:00">06:00 AM</option>
                        <option value="08:00">08:00 AM</option>
                        <option value="10:00">10:00 AM</option>
                        <option value="12:00">12:00 PM</option>
                        <option value="14:00">02:00 PM</option>
                        <option value="18:00">06:00 PM</option>
                    </select>
                </div>
            </div>
            
            <button class="button" onclick="showPage('seat-page')">Continue to Seat Selection</button>
        </div>
        
        <!-- Seat Selection Page -->
        <div class="page" id="seat-page">
            <h2>Select Your Seat</h2>
            <div class="seat-info">
                <div>
                    <div class="indicator" style="background-color: #f9f9f9; border: 1px solid #ccc;"></div>
                    Available
                </div>
                <div>
                    <div class="indicator" style="background-color: #e60000;"></div>
                    Selected
                </div>
                <div>
                    <div class="indicator" style="background-color: #ddd;"></div>
                    Unavailable
                </div>
            </div>
            
            <div class="seat-layout">
                <div class="seat">1</div>
                <div class="seat">2</div>
                <div class="seat unavailable">3</div>
                <div class="seat">4</div>
                <div class="seat">5</div>
                <div class="seat">6</div>
                <div class="seat">7</div>
                <div class="seat">8</div>
                <div class="seat">9</div>
                <div class="seat unavailable">10</div>
                <div class="seat">11</div>
                <div class="seat">12</div>
                <div class="seat">13</div>
                <div class="seat">14</div>
                <div class="seat unavailable">15</div>
                <div class="seat">16</div>
                <div class="seat">17</div>
                <div class="seat">18</div>
                <div class="seat">19</div>
                <div class="seat">20</div>
                <div class="seat">21</div>
                <div class="seat unavailable">22</div>
                <div class="seat">23</div>
                <div class="seat">24</div>
            </div>
            
            <div style="margin-top: 30px; text-align: center;">
                <p>Selected Seat: <span id="selected-seat">None</span></p>
                <p>Price: MWK <span id="seat-price">0</span></p>
            </div>
            
            <button class="button" onclick="showPage('confirmation-page')" style="margin-top: 20px;">Continue to Confirmation</button>
        </div>
        
        <!-- Confirmation Page -->
        <div class="page" id="confirmation-page">
            <h2>Trip Summary</h2>
            <p style="margin-bottom: 20px;">Please review your trip details</p>
            
            <div class="summary-item">
                <div>Route</div>
                <div id="summary-route">Lilongwe to Blantyre</div>
            </div>
            
            <div class="summary-item">
                <div>Date & Time</div>
                <div id="summary-datetime">Mar 8, 2025 - 10:00 AM</div>
            </div>
            
            <div class="summary-item">
                <div>Seat Number</div>
                <div id="summary-seat">5</div>
            </div>
            
            <div class="summary-item">
                <div>Bus Type</div>
                <div>Luxury Coach</div>
            </div>
            
            <div class="summary-item">
                <div>Ticket Price</div>
                <div>MWK 30,000</div>
            </div>
            
            <div class="summary-item">
                <div>Booking Fee</div>
                <div>MWK 500</div>
            </div>
            
            <div class="summary-item total">
                <div>Total Amount</div>
                <div>MWK 30,500</div>
            </div>
            
            <button class="button" onclick="showPage('payment-page')" style="margin-top: 20px;">Proceed to Payment</button>
        </div>
        
        <!-- Payment Page -->
        <div class="page" id="payment-page">
            <h2>Payment</h2>
            <p style="margin-bottom: 20px;">Choose your preferred payment method</p>
            
            <div class="payment-methods">
        <div class="payment-method" onclick="selectPaymentMethod('visa')">
            <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Visa.svg" alt="Visa Card">
        </div>
        <div class="payment-method" onclick="selectPaymentMethod('airtel')">
            <img src="air.jpeg" alt="Airtel Money">
        </div>
        <div class="payment-method" onclick="selectPaymentMethod('mpamba')">
            <img src="tnm.jpg" alt="TNM Mpamba">
        </div>
    </div>

    <!-- Display payment info -->
    <div id="payment-info"></div>

    <!-- Visa Card Form -->
    <div id="visa-form" style="display: none;">
        <div class="form-group">
            <label for="card-number">Card Number</label>
            <input type="text" id="card-number" placeholder="Enter your card number">
        </div>

        <div class="date-time-container">
            <div class="form-group">
                <label for="expiry">Expiry Date</label>
                <input type="text" id="expiry" placeholder="MM/YY">
            </div>
            
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="password" id="cvv" placeholder="123">
            </div>
        </div>

        <div class="form-group">
            <label for="name">Name on Card</label>
            <input type="text" id="name" placeholder="Enter your name">
        </div>
    </div>
            
            <div class="security-note">
                <i class="fas fa-lock"></i> Your payment information is secure and encrypted
            </div>
            
            <button class="button" onclick="processPayment()">Pay MWK 35,500</button>
            <div id="loading" class="loading-spinner"></div>
        </div>
        
        <!-- Ticket Page -->
        <div class="page" id="ticket-page">
            <h2>E-Ticket</h2>
            <p style="margin-bottom: 20px;">Your ticket has been generated successfully</p>
            
            <div class="ticket">
                <h3>POST BUS MALAWI</h3>
                <p>E-Ticket</p>
                
                <div class="qr-code">
                    <img src="/api/placeholder/200/200" alt="QR Code">
                </div>
                
                <div class="ticket-details">
                    <div><strong>Passenger:</strong> <span id="ticket-name">John Doe</span></div>
                    <div><strong>Route:</strong> <span id="ticket-route">Lilongwe to Blantyre</span></div>
                    <div><strong>Date:</strong> <span id="ticket-date">Mar 8, 2025</span></div>
                    <div><strong>Time:</strong> <span id="ticket-time">10:00 AM</span></div>
                    <div><strong>Seat:</strong> <span id="ticket-seat">5</span></div>
                    <div><strong>Ticket ID:</strong> <span id="ticket-id">PBM20250308105</span></div>
                </div>
                
                <p style="font-size: 12px; color: #666;">Please show this QR code to board the bus</p>
            </div>
            
            <button class="button" onclick="downloadTicket()" style="margin-top: 20px;">Download Ticket</button>
            <button class="button" onclick="shareTicket()" style="margin-top: 10px; background-color: #4CAF50;">Share Ticket</button>
        </div>
        
        <!-- Staff Validation Page -->
        <div class="page" id="validation-page">
            <h2>Ticket Validation</h2>
            <p style="margin-bottom: 20px;">Scan passenger's QR code</p>
            
            <div class="scanner-area">
                <i class="fas fa-qrcode"></i>
                <p>Position QR code in this area</p>
                <button style="width: 80%; margin-top: 20px; background-color: #4CAF50;" onclick="simulateScan()">
                    <i class="fas fa-camera"></i> Scan QR Code
                </button>
            </div>
            
            <div class="scan-result" id="scan-result">
                <h3>Ticket Valid ✓</h3>
                <div class="ticket-details">
                    <div><strong>Passenger:</strong> John Doe</div>
                    <div><strong>Route:</strong> Lilongwe to Blantyre</div>
                    <div><strong>Date:</strong> Mar 8, 2025</div>
                    <div><strong>Time:</strong> 10:00 AM</div>
                    <div><strong>Seat:</strong> 5</div>
                    <div><strong>Ticket ID:</strong> PBM20250308105</div>
                </div>
                <button style="margin-top: 15px; background-color: #4CAF50;">
                    Confirm Boarding
                </button>
            </div>
        </div>
    </div>
    
    <div class="back-to-top" id="backToTop" onclick="scrollToTop()">
        <i class="fas fa-arrow-up"></i>
    </div>
    
    <!-- <footer class="footer">
        <div class="footer-links">
            <a href="about .php" class="footer-link">About Us</a>
            <a href="privacy.php" class="footer-link">Terms $ Privacy</a>
            <a href="#" class="footer-link">Privacy</a>
            <a href="fao.php" class="footer-link">FAQs</a>
            <a href="contact.php" class="footer-link">Contact</a>
        </div>
        <div class="copyright">
            © 2025 Post Bus Malawi. All rights reserved.
       
    </footer> -->
    <script src="script.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>  
<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Initialize the map
    let map = L.map("map").setView([-13.9626, 33.7741], 7); // Centered in Malawi

    // Add OpenStreetMap tiles
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "&copy; OpenStreetMap contributors",
    }).addTo(map);

    let routeLayer; // To hold the route
    let clickCount = 0; // Track number of clicks (1st -> departure, 2nd -> destination)

    // City coordinates
    const locations = {
        lilongwe: [-13.9626, 33.7741],
        blantyre: [-15.7861, 35.0058],
        mzuzu: [-11.462, 34.0206],
        zomba: [-15.3859, 35.3186],
        mangochi: [-14.4789, 35.2645]
    };

    // Reverse lookup for city name based on coordinates
    function getNearestCity(lat, lng) {
        let nearestCity = null;
        let minDistance = Infinity;

        Object.entries(locations).forEach(([city, coords]) => {
            let distance = Math.sqrt(Math.pow(coords[0] - lat, 2) + Math.pow(coords[1] - lng, 2));
            if (distance < minDistance) {
                minDistance = distance;
                nearestCity = city;
            }
        });

        return nearestCity;
    }

    // Function to update the route
    function updateRoute() {
        let departure = document.getElementById("departure").value;
        let destination = document.getElementById("destination").value;

        if (departure && destination && departure !== destination) {
            let start = locations[departure];
            let end = locations[destination];

            if (routeLayer) {
                map.removeLayer(routeLayer); // Remove previous route
            }

            // Draw a polyline (temporary route representation)
            routeLayer = L.polyline([start, end], { color: "blue", weight: 5 }).addTo(map);
            map.fitBounds([start, end]); // Adjust map view to fit route
        }
    }

    // Event listeners for dropdowns
    document.getElementById("departure").addEventListener("change", updateRoute);
    document.getElementById("destination").addEventListener("change", updateRoute);

    // Handle map clicks
    map.on("click", function (e) {
        let nearestCity = getNearestCity(e.latlng.lat, e.latlng.lng);
        if (nearestCity) {
            if (clickCount % 2 === 0) {
                document.getElementById("departure").value = nearestCity;
            } else {
                document.getElementById("destination").value = nearestCity;
            }
            clickCount++;
            updateRoute(); // Update map route
        }
    });
});

        /*payment method selected*/
        function selectPaymentMethod(method) {
            let paymentInfo = document.getElementById("payment-info");
            let visaForm = document.getElementById("visa-form");

            // Hide payment info and form by default
            paymentInfo.style.display = "none";
            visaForm.style.display = "none";

            // Reset form fields when switching payment method
            document.getElementById("card-number").value = "";
            document.getElementById("expiry").value = "";
            document.getElementById("cvv").value = "";
            document.getElementById("name").value = "";

            // Display the correct information or form based on selected method
            if (method === "airtel") {
                paymentInfo.innerHTML = "Use Airtel Money number: <strong>+265 99 123 4567</strong>";
                paymentInfo.style.display = "block";
            } else if (method === "mpamba") {
                paymentInfo.innerHTML = "Use TNM Mpamba number: <strong>+265 88 987 6543</strong>";
                paymentInfo.style.display = "block";
            } else if (method === "visa") {
                visaForm.style.display = "block";
            }
        }
        // Switch between pages
        // Switch between pages
function showPage(pageId) {
    // Hide all pages
    document.querySelectorAll('.page').forEach(page => {
        page.classList.remove('active');
    });
    
    // Show selected page
    document.getElementById(pageId).classList.add('active');
    
    // Update navigation
    document.querySelectorAll('.nav-item').forEach(item => {
        item.classList.remove('active');
    });
    
    // Update page-specific data
    updatePageData(pageId);
}

// Update data on each page
function updatePageData(pageId) {
    if (pageId === 'confirmation-page') {
        // Get selected values from route page
        const departure = document.getElementById('departure').value || 'Lilongwe';
        const destination = document.getElementById('destination').value || 'Blantyre';
        const date = document.getElementById('travel-date').value || '2025-03-08';
        const time = document.getElementById('travel-time').value || '10:00';
        const seat = document.getElementById('selected-seat').innerText || '5';
        
        // Format date
        const formattedDate = new Date(date).toLocaleDateString('en-US', {
            month: 'short',
            day: 'numeric',
            year: 'numeric'
        });
        
        // Update summary
        document.getElementById('summary-route').innerText = 
            capitalizeFirstLetter(departure) + ' to ' + capitalizeFirstLetter(destination);
        document.getElementById('summary-datetime').innerText = 
            formattedDate + ' - ' + formatTime(time);
        document.getElementById('summary-seat').innerText = seat;
    }
    
    if (pageId === 'ticket-page') {
        // Get details from confirmation page
        const route = document.getElementById('summary-route').innerText;
        const datetime = document.getElementById('summary-datetime').innerText;
        const seat = document.getElementById('summary-seat').innerText;
        const name = document.getElementById('name').value || 'John Doe';
        
        // Split datetime
        const dateParts = datetime.split(' - ');
        
        // Update ticket
        document.getElementById('ticket-name').innerText = name;
        document.getElementById('ticket-route').innerText = route;
        document.getElementById('ticket-date').innerText = dateParts[0];
        document.getElementById('ticket-time').innerText = dateParts[1];
        document.getElementById('ticket-seat').innerText = seat;
        
        // Generate random ticket ID
        const ticketId = 'PBM' + new Date().toISOString().slice(0,10).replace(/-/g,'') + 
            Math.floor(Math.random() * 1000).toString().padStart(3, '0');
        document.getElementById('ticket-id').innerText = ticketId;
    }
}

// Initialize seat selection
document.querySelectorAll('.seat').forEach(seat => {
    if (!seat.classList.contains('unavailable')) {
        seat.addEventListener('click', function() {
            // Deselect all seats
            document.querySelectorAll('.seat').forEach(s => {
                s.classList.remove('selected');
            });
            
            // Select this seat
            this.classList.add('selected');
            
            // Update selected seat info
            document.getElementById('selected-seat').innerText = this.innerText;
            document.getElementById('seat-price').innerText = '15,000';
        });
    }
});

// Select payment method - FIXED VERSION
function selectPaymentMethod(method) {
    // Add visual selection for the clicked payment method
    document.querySelectorAll('.payment-method').forEach(methodEl => {
        methodEl.classList.remove('selected');
    });
    
    // Find the clicked element and add selected class
    document.querySelector(`.payment-method[onclick="selectPaymentMethod('${method}')"]`).classList.add('selected');
    
    // Get references to the elements
    let paymentInfo = document.getElementById("payment-info");
    let visaForm = document.getElementById("visa-form");

    // Hide payment info and form by default
    paymentInfo.style.display = "none";
    visaForm.style.display = "none";

    // Reset form fields when switching payment method
    if (document.getElementById("card-number")) {
        document.getElementById("card-number").value = "";
        document.getElementById("expiry").value = "";
        document.getElementById("cvv").value = "";
        document.getElementById("name").value = "";
    }

    // Display the correct information or form based on selected method
    if (method === "airtel") {
        paymentInfo.innerHTML = "Use Airtel Money number: <strong>+265 984993671</strong>";
        paymentInfo.style.display = "block";
    } else if (method === "mpamba") {
        paymentInfo.innerHTML = "Use TNM Mpamba number: <strong>+265 88 2440241</strong>";
        paymentInfo.style.display = "block";
    } else if (method === "visa") {
        visaForm.style.display = "block";
    }
}

// Process payment
function processPayment() {
    const loadingSpinner = document.getElementById('loading');
    const payButton = document.querySelector('#payment-page button');
    
    // Show loading
    loadingSpinner.style.display = 'block';
    payButton.disabled = true;
    
    // Simulate processing
    setTimeout(() => {
        loadingSpinner.style.display = 'none';
        payButton.disabled = false;
        showPage('ticket-page');
    }, 2000);
}

// Simulate ticket download
function downloadTicket() {
    alert('Ticket downloaded successfully!');
}

// Simulate ticket sharing
function shareTicket() {
    alert('Share options opened');
}

// Simulate QR code scan
function simulateScan() {
    const scanResult = document.getElementById('scan-result');
    
    // Show loading effect
    scanResult.style.display = 'none';
    
    // Simulate scanning
    setTimeout(() => {
        scanResult.style.display = 'block';
    }, 1500);
}

// Helper function to capitalize first letter
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

// Helper function to format time
function formatTime(timeString) {
    const [hours, minutes] = timeString.split(':');
    const hour = parseInt(hours);
    return (hour < 12 ? hour + ':' + minutes + ' AM' : 
            (hour === 12 ? '12:' + minutes + ' PM' : 
            (hour - 12) + ':' + minutes + ' PM'));
}
    </script>
</body>
</html>