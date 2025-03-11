<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST BUS MALAWI - Book Your Trip</title>
    <style>
        :root {
            --primary-color: #3a0ca3;
            --secondary-color: #4361ee;
            --accent-color: #f72585;
            --light-color: #f1faee;
            --dark-color: #1d3557;
            --success-color: #06d6a0;
            --warning-color: #ffd166;
            --danger-color: #ef476f;
            --gray-color: #e9ecef;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: var(--dark-color);
            line-height: 1.6;
        }

        .container {
            max-width: 480px;
            margin: 0 auto;
            padding: 0;
            background-color: white;
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 15px;
            text-align: center;
            position: relative;
        }

        .header h1 {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .back-button {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 1.2rem;
        }

        .progress-bar {
            display: flex;
            padding: 15px;
            background-color: white;
            justify-content: space-between;
            position: relative;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .progress-bar::before {
            content: '';
            position: absolute;
            height: 3px;
            background-color: var(--gray-color);
            top: 50%;
            left: 40px;
            right: 40px;
            transform: translateY(-50%);
            z-index: 1;
        }

        .progress-step {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: var(--gray-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            position: relative;
            z-index: 2;
        }

        .progress-step.active {
            background-color: var(--secondary-color);
        }

        .progress-step.completed {
            background-color: var(--success-color);
        }

        .booking-section {
            padding: 20px;
            display: none;
        }

        .booking-section.active {
            display: block;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark-color);
        }

        .input-group select,
        .input-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            color: var(--dark-color);
            background-color: white;
            transition: border 0.3s;
        }

        .input-group select:focus,
        .input-group input:focus {
            border-color: var(--secondary-color);
            outline: none;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: var(--secondary-color);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s;
            width: 100%;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: var(--primary-color);
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--secondary-color);
            color: var(--secondary-color);
        }

        .btn-outline:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        /* Seat Selection Styles */
        .bus-layout {
            background-color: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            position: relative;
        }

        .bus-front {
            height: 40px;
            background-color: var(--dark-color);
            border-radius: 20px 20px 0 0;
            margin-bottom: 10px;
            position: relative;
        }

        .bus-front::after {
            content: 'Driver';
            position: absolute;
            color: white;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 0.8rem;
        }

        .seats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-top: 20px;
        }

        .seat {
            width: 100%;
            aspect-ratio: 1/1;
            border-radius: 5px;
            background-color: var(--success-color);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-weight: bold;
            color: white;
            transition: all 0.3s;
        }

        .seat.aisle {
            visibility: hidden;
        }

        .seat.selected {
            background-color: var(--secondary-color);
            transform: scale(0.95);
            box-shadow: 0 0 0 2px white, 0 0 0 4px var(--secondary-color);
        }

        .seat.occupied {
            background-color: var(--gray-color);
            cursor: not-allowed;
            color: #999;
        }

        .legend {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 15px;
            font-size: 0.8rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .legend-color {
            width: 15px;
            height: 15px;
            border-radius: 3px;
        }

        /* Summary Styles */
        .summary-card {
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .summary-card h3 {
            color: var(--primary-color);
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .summary-label {
            font-weight: 600;
            color: var(--dark-color);
        }

        .summary-value {
            color: var(--secondary-color);
            font-weight: 500;
        }

        .total-price {
            border-top: 2px dashed #eee;
            margin-top: 15px;
            padding-top: 15px;
            font-size: 1.2rem;
            font-weight: 700;
        }

        .confirmation-message {
            background-color: var(--success-color);
            color: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            margin-top: 20px;
        }

        .confirmation-message h3 {
            margin-bottom: 10px;
        }

        .floating-actions {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: white;
            padding: 15px 20px;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
            display: flex;
            gap: 10px;
            max-width: 480px;
            margin: 0 auto;
        }

        .date-time-picker {
            display: flex;
            gap: 10px;
        }

        .date-time-picker .input-group {
            flex: 1;
        }

        @media (max-width: 480px) {
            .container {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <button class="back-button" id="backButton">←</button>
            <h1>POST BUS MALAWI</h1>
            <p>Book Your Journey</p>
        </header>

        <div class="progress-bar">
            <div class="progress-step active" id="step1">1</div>
            <div class="progress-step" id="step2">2</div>
            <div class="progress-step" id="step3">3</div>
            <div class="progress-step" id="step4">4</div>
        </div>

        <!-- Route Selection Section -->
        <section class="booking-section active" id="routeSection">
            <h2>Select Your Route</h2>
            <div class="input-group">
                <label for="departureCity">Departure</label>
                <select id="departureCity" class="form-control">
                    <option value="">Select departure city</option>
                    <option value="Lilongwe">Lilongwe</option>
                    <option value="Blantyre">Blantyre</option>
                    <option value="Mzuzu">Mzuzu</option>
                    <option value="Zomba">Zomba</option>
                    <option value="Mangochi">Mangochi</option>
                </select>
            </div>

            <div class="input-group">
                <label for="destinationCity">Destination</label>
                <select id="destinationCity" class="form-control">
                    <option value="">Select destination city</option>
                    <option value="Lilongwe">Lilongwe</option>
                    <option value="Blantyre">Blantyre</option>
                    <option value="Mzuzu">Mzuzu</option>
                    <option value="Zomba">Zomba</option>
                    <option value="Mangochi">Mangochi</option>
                </select>
            </div>

            <div class="date-time-picker">
                <div class="input-group">
                    <label for="travelDate">Travel Date</label>
                    <input type="date" id="travelDate" class="form-control" min="">
                </div>

                <div class="input-group">
                    <label for="travelTime">Time</label>
                    <select id="travelTime" class="form-control">
                        <option value="">Select time</option>
                        <option value="06:00">06:00 AM</option>
                        <option value="09:00">09:00 AM</option>
                        <option value="12:00">12:00 PM</option>
                        <option value="15:00">03:00 PM</option>
                        <option value="18:00">06:00 PM</option>
                    </select>
                </div>
            </div>

            <div class="input-group">
                <label for="passengerCount">Number of Passengers</label>
                <select id="passengerCount" class="form-control">
                    <option value="1">1 Passenger</option>
                    <option value="2">2 Passengers</option>
                    <option value="3">3 Passengers</option>
                    <option value="4">4 Passengers</option>
                    <option value="5">5 Passengers</option>
                </select>
            </div>

            <button class="btn" id="routeNextBtn">Continue to Seat Selection</button>
        </section>

        <!-- Seat Selection Section -->
        <section class="booking-section" id="seatSection">
            <h2>Select Your Seat</h2>
            <p>Choose your preferred seat(s) from the available options.</p>

            <div class="bus-layout">
                <div class="bus-front"></div>
                <div class="seats-grid" id="seatsGrid">
                    <!-- Seats will be dynamically generated here -->
                </div>

                <div class="legend">
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: var(--success-color);"></div>
                        <span>Available</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: var(--secondary-color);"></div>
                        <span>Selected</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: var(--gray-color);"></div>
                        <span>Occupied</span>
                    </div>
                </div>
            </div>

            <div class="floating-actions">
                <button class="btn btn-outline" id="seatBackBtn">Back</button>
                <button class="btn" id="seatNextBtn">Continue</button>
            </div>
        </section>

        <!-- Passenger Details Section -->
        <section class="booking-section" id="detailsSection">
            <h2>Passenger Details</h2>
            <p>Please provide information for all passengers.</p>

            <div id="passengerForms">
                <!-- Passenger forms will be generated here -->
            </div>

            <div class="floating-actions">
                <button class="btn btn-outline" id="detailsBackBtn">Back</button>
                <button class="btn" id="detailsNextBtn">Continue to Summary</button>
            </div>
        </section>

        <!-- Confirmation Section -->
        <section class="booking-section" id="confirmationSection">
            <h2>Trip Summary</h2>
            <p>Please review your booking details before payment.</p>

            <div class="summary-card">
                <h3>Booking Details</h3>
                <div class="summary-item">
                    <span class="summary-label">Route:</span>
                    <span class="summary-value" id="summaryRoute">Lilongwe to Blantyre</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Date & Time:</span>
                    <span class="summary-value" id="summaryDateTime">March 5, 2025 - 09:00 AM</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Passengers:</span>
                    <span class="summary-value" id="summaryPassengers">2</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Seat(s):</span>
                    <span class="summary-value" id="summarySeats">A3, A4</span>
                </div>
                <div class="summary-item total-price">
                    <span class="summary-label">Total Price:</span>
                    <span class="summary-value" id="summaryPrice">MWK 7,500</span>
                </div>
            </div>

            <div class="input-group">
                <label for="paymentMethod">Payment Method</label>
                <select id="paymentMethod" class="form-control">
                    <option value="mpamba">TNM Mpamba</option>
                    <option value="airtel">Airtel Money</option>
                    <option value="visa">Visa Card</option>
                    <option value="mastercard">MasterCard</option>
                </select>
            </div>

            <div class="floating-actions">
                <button class="btn btn-outline" id="confirmationBackBtn">Back</button>
                <button class="btn" id="confirmBtn">Confirm & Pay</button>
            </div>
        </section>

        <!-- Success Section (hidden initially) -->
        <section class="booking-section" id="successSection">
            <div class="confirmation-message">
                <h3>Booking Confirmed!</h3>
                <p>Your booking has been successfully completed. A confirmation has been sent to your email.</p>
                <p>Booking Reference: <strong id="bookingReference">PB2503242</strong></p>
            </div>

            <div class="summary-card">
                <h3>Trip Details</h3>
                <div class="summary-item">
                    <span class="summary-label">Route:</span>
                    <span class="summary-value" id="successRoute">Lilongwe to Blantyre</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Date & Time:</span>
                    <span class="summary-value" id="successDateTime">March 5, 2025 - 09:00 AM</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Passengers:</span>
                    <span class="summary-value" id="successPassengers">2</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Seat(s):</span>
                    <span class="summary-value" id="successSeats">A3, A4</span>
                </div>
            </div>

            <button class="btn" id="homeBtn">Back to Home</button>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set minimum date to today
            const today = new Date();
            const formattedDate = today.toISOString().split('T')[0];
            document.getElementById('travelDate').min = formattedDate;
            
            // Initialize variables
            let currentSection = 1;
            let selectedSeats = [];
            let passengerCount = 1;
            const sections = ['routeSection', 'seatSection', 'detailsSection', 'confirmationSection', 'successSection'];
            const pricePerSeat = 3750; // Price in MWK

            // Navigation functions
            function showSection(sectionIndex) {
                // Hide all sections
                document.querySelectorAll('.booking-section').forEach(section => {
                    section.classList.remove('active');
                });
                
                // Show the requested section
                document.getElementById(sections[sectionIndex - 1]).classList.add('active');
                
                // Update progress bar
                document.querySelectorAll('.progress-step').forEach((step, index) => {
                    if (index + 1 < sectionIndex) {
                        step.classList.add('completed');
                        step.classList.remove('active');
                    } else if (index + 1 === sectionIndex) {
                        step.classList.add('active');
                        step.classList.remove('completed');
                    } else {
                        step.classList.remove('active', 'completed');
                    }
                });
                
                currentSection = sectionIndex;
                
                // Hide back button on first section
                document.getElementById('backButton').style.visibility = currentSection === 1 ? 'hidden' : 'visible';
            }

            // Handle back button click
            document.getElementById('backButton').addEventListener('click', function() {
                if (currentSection > 1) {
                    showSection(currentSection - 1);
                }
            });

            // Route selection next button
            document.getElementById('routeNextBtn').addEventListener('click', function() {
                const departure = document.getElementById('departureCity').value;
                const destination = document.getElementById('destinationCity').value;
                const date = document.getElementById('travelDate').value;
                const time = document.getElementById('travelTime').value;
                passengerCount = parseInt(document.getElementById('passengerCount').value);
                
                if (!departure || !destination || !date || !time) {
                    alert('Please fill all fields to continue');
                    return;
                }
                
                if (departure === destination) {
                    alert('Departure and destination cannot be the same');
                    return;
                }
                
                // Generate seats
                generateSeats();
                
                // Move to next section
                showSection(2);
            });

            // Seat selection buttons
            document.getElementById('seatBackBtn').addEventListener('click', function() {
                showSection(1);
            });
            
            document.getElementById('seatNextBtn').addEventListener('click', function() {
                if (selectedSeats.length !== passengerCount) {
                    alert(`Please select exactly ${passengerCount} seat(s)`);
                    return;
                }
                
                // Generate passenger forms
                generatePassengerForms();
                
                // Move to next section
                showSection(3);
            });
            
            // Details section buttons
            document.getElementById('detailsBackBtn').addEventListener('click', function() {
                showSection(2);
            });
            
            document.getElementById('detailsNextBtn').addEventListener('click', function() {
                // Validate passenger forms
                const forms = document.querySelectorAll('.passenger-form');
                let isValid = true;
                
                forms.forEach(form => {
                    const inputs = form.querySelectorAll('input');
                    inputs.forEach(input => {
                        if (!input.value) {
                            isValid = false;
                        }
                    });
                });
                
                if (!isValid) {
                    alert('Please fill all passenger details');
                    return;
                }
                
                // Update summary
                updateSummary();
                
                // Move to next section
                showSection(4);
            });
            
            // Confirmation section buttons
            document.getElementById('confirmationBackBtn').addEventListener('click', function() {
                showSection(3);
            });
            
            document.getElementById('confirmBtn').addEventListener('click', function() {
                const paymentMethod = document.getElementById('paymentMethod').value;
                
                if (!paymentMethod) {
                    alert('Please select a payment method');
                    return;
                }
                
                // In a real app, you would process payment here
                
                // Generate booking reference
                const bookingRef = 'PB' + Math.floor(Math.random() * 10000000);
                document.getElementById('bookingReference').textContent = bookingRef;
                
                // Copy summary details to success section
                document.getElementById('successRoute').textContent = document.getElementById('summaryRoute').textContent;
                document.getElementById('successDateTime').textContent = document.getElementById('summaryDateTime').textContent;
                document.getElementById('successPassengers').textContent = document.getElementById('summaryPassengers').textContent;
                document.getElementById('successSeats').textContent = document.getElementById('summarySeats').textContent;
                
                // Move to success section
                showSection(5);
            });
            
            // Home button
            document.getElementById('homeBtn').addEventListener('click', function() {
                // Reset everything and go back to first section
                selectedSeats = [];
                document.getElementById('departureCity').value = '';
                document.getElementById('destinationCity').value = '';
                document.getElementById('travelDate').value = '';
                document.getElementById('travelTime').value = '';
                document.getElementById('passengerCount').value = '1';
                showSection(1);
            });
            
            // Function to generate seats
            function generateSeats() {
                const seatsGrid = document.getElementById('seatsGrid');
                seatsGrid.innerHTML = '';
                
                // Clear selected seats
                selectedSeats = [];
                
                // Create a 10x4 grid of seats (40 seats total)
                const rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
                
                // Random occupied seats (in a real app, this would come from the server)
                const occupiedSeats = generateRandomOccupiedSeats(10);
                
                for (let i = 0; i < 40; i++) {
                    const row = Math.floor(i / 4);
                    const col = i % 4;
                    const seatNumber = rows[row] + (col + 1);
                    
                    const seat = document.createElement('div');
                    seat.className = 'seat';
                    
                    // Add aisle in the middle (between seats 2 and 3)
                    if (col === 1) {
                        const aisle = document.createElement('div');
                        aisle.className = 'seat aisle';
                        seatsGrid.appendChild(aisle);
                    }
                    
                    // Check if seat is occupied
                    if (occupiedSeats.includes(seatNumber)) {
                        seat.classList.add('occupied');
                    } else {
                        seat.addEventListener('click', function() {
                            if (selectedSeats.includes(seatNumber)) {
                                // Deselect seat
                                selectedSeats = selectedSeats.filter(s => s !== seatNumber);
                                seat.classList.remove('selected');
                            } else {
                                // Check if we've already selected the maximum number of seats
                                if (selectedSeats.length >= passengerCount) {
                                    // Deselect the first selected seat
                                    const firstSeat = selectedSeats.shift();
                                    document.querySelector(`.seat:not(.aisle):not(.occupied):contains('${firstSeat}')`).classList.remove('selected');
                                }
                                
                                // Select this seat
                                selectedSeats.push(seatNumber);
                                seat.classList.add('selected');
                            }
                        });
                    }
                    
                    seat.textContent = seatNumber;
                    seatsGrid.appendChild(seat);
                }
                
                // Helper method to check text content (for selecting seats by number)
                HTMLElement.prototype.contains = function(text) {
                    return this.textContent === text;
                };
            }
            
            // Function to generate random occupied seats
            function generateRandomOccupiedSeats(count) {
                const occupied = [];
                const rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
                
                while (occupied.length < count) {
                    const row = rows[Math.floor(Math.random() * rows.length)];
                    const col = Math.floor(Math.random() * 4) + 1;
                    const seat = row + col;
                    
                    if (!occupied.includes(seat)) {
                        occupied.push(seat);
                    }
                }
                
                return occupied;
            }
            
            // Function to generate passenger forms
            function generatePassengerForms() {
                const passengerForms = document.getElementById('passengerForms');
                passengerForms.innerHTML = '';
                
                for (let i = 0; i < passengerCount; i++) {
                    const form = document.createElement('div');
                    form.className = 'passenger-form';
                    form.innerHTML = `
                        <h3>Passenger ${i+1} - Seat ${selectedSeats[i]}</h3>
                        <div class="input-group">
                            <label for="passenger${i}Name">Full Name</label>
                            <input type="text" id="passenger${i}Name" class="form-control" placeholder="Enter full name" required>
                        </div>
                        <div class="input-group">
                            <label for="passenger${i}ID">ID Number</label>
                            <input type="text" id="passenger${i}ID" class="form-control" placeholder="National ID or Passport" required>
                        </div>
                        <div class="input-group">
                            <label for="passenger${i}Contact">Contact Number</label>
                            <input type="tel" id="passenger${i}Contact" class="form-control" placeholder="Phone number" required>
                        </div>
                    `;
                    passengerForms.appendChild(form);
                }
            }
            
            // Function to update summary
            function updateSummary() {
                const departure = document.getElementById('departureCity').value;
                const destination = document.getElementById('destinationCity').value;
                const date = new Date(document.getElementById('travelDate').value);
                const time = document.getElementById('travelTime').value;
                
                // Format date
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const formattedDate = date.toLocaleDateString('en-US', options);
                
                // Format time
                const timeObj = new Date(`2000-01-01T${time}`);
                const formattedTime = timeObj.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
                
                // Update summary elements
                document.getElementById('summaryRoute').textContent = `${departure} to ${destination}`;
                document.getElementById('summaryDateTime').textContent = `${formattedDate} - ${formattedTime}`;
                document.getElementById('summaryPassengers').textContent = passengerCount;
                document.getElementById('summarySeats').textContent = selectedSeats.join(', ');
                
                // Calculate total price
                const totalPrice = passengerCount * pricePerSeat;
                document.getElementById('summaryPrice').textContent = `MWK ${totalPrice.toLocaleString()}`;
            }
            
            // Initialize the first section
            showSection(1);
        });
    </script>
</body>
</html>