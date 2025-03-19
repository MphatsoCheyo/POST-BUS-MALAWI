<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Bus Malawi - Travel History & Rebooking</title>
    <style>
        :root {
            --primary-color: #007A33; /* Malawi flag green */
            --secondary-color: #CE1126; /* Malawi flag red */
            --accent-color: #000000; /* Malawi flag black */
            --background-color: #f5f5f5;
            --text-color: #333;
            --light-gray: #e0e0e0;
            --border-color: #ddd;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        header {
            background-color: var(--primary-color);
            color: white;
            padding: 15px 0;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .logo {
            width: 50px;
            height: 50px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 20px;
            color: var(--primary-color);
        }
        
        .tabs {
            display: flex;
            background-color: white;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 0 0 8px 8px;
        }
        
        .tab {
            flex: 1;
            text-align: center;
            padding: 15px 0;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .tab.active {
            color: var(--primary-color);
            border-bottom: 3px solid var(--primary-color);
        }
        
        .content {
            display: none;
            animation: fadeIn 0.5s;
        }
        
        .content.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .card-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--primary-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .search-box {
            display: flex;
            margin-bottom: 20px;
        }
        
        .search-box input {
            flex: 1;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 4px 0 0 4px;
            font-size: 16px;
        }
        
        .search-box button {
            padding: 12px 15px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }
        
        .trip-card {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            margin-bottom: 15px;
            overflow: hidden;
        }
        
        .trip-header {
            background-color: rgba(0, 122, 51, 0.1);
            padding: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .trip-date {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .trip-status {
            font-size: 14px;
            padding: 4px 8px;
            border-radius: 12px;
            background-color: var(--light-gray);
        }
        
        .trip-status.completed {
            background-color: rgba(0, 122, 51, 0.2);
            color: var(--primary-color);
        }
        
        .trip-status.upcoming {
            background-color: rgba(206, 17, 38, 0.2);
            color: var(--secondary-color);
        }
        
        .trip-details {
            padding: 15px;
        }
        
        .route-info {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .route-points {
            flex: 1;
        }
        
        .route-separator {
            padding: 0 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: var(--primary-color);
        }
        
        .route-line {
            height: 30px;
            width: 2px;
            background-color: var(--primary-color);
            margin: 5px 0;
        }
        
        .departure, .arrival {
            font-weight: 600;
        }
        
        .time-info {
            font-size: 14px;
            color: #555;
            margin-top: 3px;
        }
        
        .trip-meta {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #555;
            padding-top: 10px;
            border-top: 1px solid var(--light-gray);
        }
        
        .trip-actions {
            display: flex;
            padding: 10px 15px;
            background-color: #f9f9f9;
            border-top: 1px solid var(--light-gray);
        }
        
        .btn {
            padding: 8px 15px;
            border-radius: 4px;
            border: none;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            margin-right: 10px;
        }
        
        .btn-secondary {
            background-color: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #005a25;
        }
        
        .btn-secondary:hover {
            background-color: rgba(0, 122, 51, 0.1);
        }
        
        .favorite-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            margin-bottom: 15px;
            background-color: white;
            position: relative;
        }
        
        .favorite-route {
            flex: 1;
        }
        
        .favorite-details {
            font-size: 14px;
            color: #555;
            margin-top: 5px;
        }
        
        .favorite-actions {
            display: flex;
            gap: 10px;
        }
        
        .icon-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
        }
        
        .book-btn {
            background-color: var(--primary-color);
            color: white;
        }
        
        .delete-btn {
            background-color: #f5f5f5;
            color: #777;
        }
        
        .delete-btn:hover {
            background-color: rgba(206, 17, 38, 0.1);
            color: var(--secondary-color);
        }
        
        .favorite-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--secondary-color);
            color: white;
            font-size: 12px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .empty-state {
            text-align: center;
            padding: 30px 0;
            color: #777;
        }
        
        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 15px;
            color: var(--light-gray);
        }
        
        .empty-state-text {
            margin-bottom: 20px;
        }
        
        .floating-notification {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: var(--primary-color);
            color: white;
            padding: 15px 25px;
            border-radius: 30px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
            display: none;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .booking-modal {
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
        
        .modal-content {
            background-color: white;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            overflow: hidden;
            animation: modalFadeIn 0.3s;
        }
        
        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .modal-header {
            background-color: var(--primary-color);
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-title {
            font-size: 18px;
            font-weight: 600;
        }
        
        .close-modal {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }
        
        .modal-body {
            padding: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .form-group input, .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 16px;
        }
        
        .modal-footer {
            padding: 15px 20px;
            display: flex;
            justify-content: flex-end;
            background-color: #f9f9f9;
            border-top: 1px solid var(--light-gray);
        }
        
        .filter-options {
            display: flex;
            margin-bottom: 20px;
            overflow-x: auto;
            padding-bottom: 5px;
            -webkit-overflow-scrolling: touch;
        }
        
        .filter-options::-webkit-scrollbar {
            height: 3px;
        }
        
        .filter-options::-webkit-scrollbar-thumb {
            background-color: var(--light-gray);
        }
        
        .filter-option {
            padding: 8px 15px;
            background-color: white;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            margin-right: 10px;
            white-space: nowrap;
            font-size: 14px;
            cursor: pointer;
        }
        
        .filter-option.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        @media (max-width: 480px) {
            .trip-actions {
                flex-direction: column;
                gap: 10px;
            }
            
            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo-container">
                <div class="logo">PB</div>
                <h1>Post Bus Malawi</h1>
            </div>
        </div>
    </header>
    
    <div class="container">
        <div class="tabs">
            <div class="tab active" data-tab="history">Booking History</div>
            <div class="tab" data-tab="favorites">Favorite Routes</div>
        </div>
        
        <div id="history-content" class="content active">
            <div class="search-box">
                <input type="text" placeholder="Search by route, date, or ticket number...">
                <button>🔍</button>
            </div>
            
            <div class="filter-options">
                <div class="filter-option active">All Trips</div>
                <div class="filter-option">Last 3 Months</div>
                <div class="filter-option">Completed</div>
                <div class="filter-option">Upcoming</div>
                <div class="filter-option">Cancelled</div>
            </div>
            
            <div class="card">
                <div class="card-title">
                    <span>Your Booking History</span>
                    <span id="trip-count">6 trips</span>
                </div>
                
                <div id="trips-list">
                    <!-- Trip history will be populated here -->
                </div>
            </div>
        </div>
        
        <div id="favorites-content" class="content">
            <div class="card">
                <div class="card-title">Your Favorite Routes</div>
                
                <div id="favorites-list">
                    <!-- Favorite routes will be populated here -->
                </div>
                
                <button id="add-favorite" class="btn btn-primary" style="width: 100%; margin-top: 10px;">
                    + Add New Favorite Route
                </button>
            </div>
        </div>
    </div>
    
    <div id="notification" class="floating-notification"></div>
    
    <div id="booking-modal" class="booking-modal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Book New Trip</div>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="booking-form">
                    <div class="form-group">
                        <label for="departure">Departure</label>
                        <select id="departure" required>
                            <option value="">Select departure city</option>
                            <option value="Lilongwe">Lilongwe</option>
                            <option value="Blantyre">Blantyre</option>
                            <option value="Mzuzu">Mzuzu</option>
                            <option value="Zomba">Zomba</option>
                            <option value="Mangochi">Mangochi</option>
                            <option value="Kasungu">Kasungu</option>
                            <option value="Karonga">Karonga</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="destination">Destination</label>
                        <select id="destination" required>
                            <option value="">Select destination city</option>
                            <option value="Lilongwe">Lilongwe</option>
                            <option value="Blantyre">Blantyre</option>
                            <option value="Mzuzu">Mzuzu</option>
                            <option value="Zomba">Zomba</option>
                            <option value="Mangochi">Mangochi</option>
                            <option value="Kasungu">Kasungu</option>
                            <option value="Karonga">Karonga</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="travel-date">Travel Date</label>
                        <input type="date" id="travel-date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="passengers">Number of Passengers</label>
                        <select id="passengers" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="bus-class">Bus Class</label>
                        <select id="bus-class" required>
                            <option value="standard">Standard</option>
                            <option value="express">Express</option>
                            <option value="luxury">Luxury</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary close-modal" style="margin-right: 10px;">Cancel</button>
                <button class="btn btn-primary" id="confirm-booking">Confirm Booking</button>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab switching functionality
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs and content
                    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                    document.querySelectorAll('.content').forEach(c => c.classList.remove('active'));
                    
                    // Add active class to clicked tab
                    this.classList.add('active');
                    
                    // Show corresponding content
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(`${tabId}-content`).classList.add('active');
                    
                    // Load data if needed
                    if (tabId === 'history') {
                        loadTripHistory();
                    } else if (tabId === 'favorites') {
                        loadFavoriteRoutes();
                    }
                });
            });
            
            // Filter options
            const filterOptions = document.querySelectorAll('.filter-option');
            filterOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove active class from all options
                    document.querySelectorAll('.filter-option').forEach(o => o.classList.remove('active'));
                    
                    // Add active class to clicked option
                    this.classList.add('active');
                    
                    // Filter trips based on selection
                    const filter = this.textContent.trim().toLowerCase();
                    loadTripHistory(filter);
                });
            });
            
            // Modal functionality
            const bookingModal = document.getElementById('booking-modal');
            const closeModalButtons = document.querySelectorAll('.close-modal');
            
            // Open modal for rebooking
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('rebook-btn')) {
                    bookingModal.style.display = 'flex';
                    
                    // Pre-fill form with trip data
                    const tripCard = e.target.closest('.trip-card');
                    const departure = tripCard.querySelector('.departure').textContent;
                    const arrival = tripCard.querySelector('.arrival').textContent;
                    
                    document.getElementById('departure').value = departure;
                    document.getElementById('destination').value = arrival;
                    
                    // Set date to tomorrow
                    const tomorrow = new Date();
                    tomorrow.setDate(tomorrow.getDate() + 1);
                    document.getElementById('travel-date').value = tomorrow.toISOString().split('T')[0];
                }
            });
            
            // Open modal for booking from favorites
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('book-btn') || e.target.parentElement.classList.contains('book-btn')) {
                    bookingModal.style.display = 'flex';
                    
                    // Pre-fill form with favorite route data
                    const favoriteItem = e.target.closest('.favorite-item');
                    const routeText = favoriteItem.querySelector('.favorite-route').textContent;
                    const [departure, arrival] = routeText.split(' to ');
                    
                    document.getElementById('departure').value = departure.trim();
                    document.getElementById('destination').value = arrival.trim();
                    
                    // Set date to tomorrow
                    const tomorrow = new Date();
                    tomorrow.setDate(tomorrow.getDate() + 1);
                    document.getElementById('travel-date').value = tomorrow.toISOString().split('T')[0];
                }
            });
            
            // Add favorite route button
            document.getElementById('add-favorite').addEventListener('click', function() {
                bookingModal.style.display = 'flex';
                document.getElementById('booking-form').reset();
                
                // Change modal title
                document.querySelector('.modal-title').textContent = 'Add Favorite Route';
                document.getElementById('confirm-booking').textContent = 'Save Route';
            });
            
            // Close modal
            closeModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    bookingModal.style.display = 'none';
                    
                    // Reset modal title
                    document.querySelector('.modal-title').textContent = 'Book New Trip';
                    document.getElementById('confirm-booking').textContent = 'Confirm Booking';
                });
            });
            
            // Close modal when clicking outside
            window.addEventListener('click', function(e) {
                if (e.target === bookingModal) {
                    bookingModal.style.display = 'none';
                }
            });
            
            // Handle booking form submission
            document.getElementById('confirm-booking').addEventListener('click', function() {
                const form = document.getElementById('booking-form');
                
                // Basic validation
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }
                
                // Get form data
                const departure = document.getElementById('departure').value;
                const destination = document.getElementById('destination').value;
                const travelDate = document.getElementById('travel-date').value;
                
                // Check if we're adding a favorite or booking
                const isAddingFavorite = this.textContent === 'Save Route';
                
                if (isAddingFavorite) {
                    // Add to favorites
                    addFavoriteRoute(departure, destination);
                    showNotification('Route added to favorites!');
                } else {
                    // Book trip
                    bookTrip(departure, destination, travelDate);
                    showNotification('Trip booked successfully!');
                }
                
                // Close modal
                bookingModal.style.display = 'none';
                
                // Reload data
                if (isAddingFavorite) {
                    loadFavoriteRoutes();
                } else {
                    loadTripHistory();
                }
            });
            
            // Load initial data
            loadTripHistory();
            loadFavoriteRoutes();
        });
        
        // Function to load trip history
        function loadTripHistory(filter = 'all') {
            const tripsList = document.getElementById('trips-list');
            
            // Get trip history from localStorage or use sample data
            let trips = JSON.parse(localStorage.getItem('postBusTrips')) || [];
            
            if (trips.length === 0) {
                // Sample trip data
                trips = [
                    {
                        id: "PB123456",
                        departure: "Lilongwe",
                        arrival: "Blantyre",
                        departureDate: "2025-03-10",
                        departureTime: "08:00",
                        arrivalTime: "12:30",
                        status: "completed",
                        busType: "Express",
                        seatsBooked: 1,
                        ticketPrice: "MWK 8,500",
                        departureTerminal: "Main Terminal"
                    },
                    {
                        id: "PB123457",
                        departure: "Blantyre",
                        arrival: "Lilongwe",
                        departureDate: "2025-02-15",
                        departureTime: "09:00",
                        arrivalTime: "13:30",
                        status: "completed",
                        busType: "Standard",
                        seatsBooked: 2,
                        ticketPrice: "MWK 7,000",
                        departureTerminal: "City Terminal"
                    },
                    {
                        id: "PB123458",
                        departure: "Lilongwe",
                        arrival: "Mzuzu",
                        departureDate: "2025-01-20",
                        departureTime: "07:30",
                        arrivalTime: "12:00",
                        status: "completed",
                        busType: "Luxury",
                        seatsBooked: 1,
                        ticketPrice: "MWK 9,500",
                        departureTerminal: "Main Terminal"
                    },
                    {
                        id: "PB123459",
                        departure: "Mzuzu",
                        arrival: "Lilongwe",
                        departureDate: "2025-04-25",
                        departureTime: "08:30",
                        arrivalTime: "13:00",
                        status: "upcoming",
                        busType: "Express",
                        seatsBooked: 1,
                        ticketPrice: "MWK 8,500",
                        departureTerminal: "Central Terminal"
                    },
                    {
                        id: "PB123460",
                        departure: "Blantyre",
                        arrival: "Zomba",
                        departureDate: "2025-01-05",
                        departureTime: "10:00",
                        arrivalTime: "11:30",
                        status: "completed",
                        busType: "Standard",
                        seatsBooked: 3,
                        ticketPrice: "MWK 3,500",
                        departureTerminal: "City Terminal"
                    },
                    {
                        id: "PB123461",
                        departure: "Lilongwe",
                        arrival: "Kasungu",
                        departureDate: "2025-02-28",
                        departureTime: "14:00",
                        arrivalTime: "16:30",
                        status: "cancelled",
                        busType: "Standard",
                        seatsBooked: 1,
                        ticketPrice: "MWK 4,500",
                        departureTerminal: "Main Terminal"
                    }
                ];
                localStorage.setItem('postBusTrips', JSON.stringify(trips));
            }
            
            // Apply filters
            if (filter !== 'all trips') {
                if (filter === 'last 3 months') {
                    const threeMonthsAgo = new Date();
                    threeMonthsAgo.setMonth(threeMonthsAgo.getMonth() - 3);
                    trips = trips.filter(trip => new Date(trip.departureDate) >= threeMonthsAgo);
                } else if (filter === 'completed' || filter === 'upcoming' || filter === 'cancelled') {
                    trips = trips.filter(trip => trip.status === filter);
                }
            }
            
            // Sort by date (newest first)
            trips.sort((a, b) => new Date(b.departureDate) - new Date(a.departureDate));
            
            // Update trip count
            document.getElementById('trip-count').textContent = `${trips.length} trips`;
            
            // Clear existing content
            tripsList.innerHTML = '';
            
            // Check if there are any trips
            if (trips.length === 0) {
                tripsList.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-state-icon">🚌</div>
                        <div class="empty-state-text">No trip history found</div>
                        <button class="btn btn-primary">Book Your First Trip</button>
                    </div>
                `;
                return;
            }
            
            // Render trip items
            trips.forEach(trip => {
                const tripItem = document.createElement('div');
                tripItem.className = 'trip-card';
                
                // Format date
                const tripDate = new Date(trip.departureDate);
                const formattedDate = tripDate.toLocaleDateString('en-GB', { 
                    weekday: 'short', 
                    day: '2-digit', 
                    month: 'short', 
                    year: 'numeric' 
                });
                
                tripItem.innerHTML = `
                    <div class="trip-header">
                        <div class="trip-date">${formattedDate}</div>
                        <div class="trip-status ${trip.status}">${trip.status.charAt(0).toUpperCase() + trip.status.slice(1)}</div>
                    </div>
                    <div class="trip-details">
                        <div class="route-info">
                            <div class="route-points">
                                <div class="departure">${trip.departure}</div>
                                <div class="time-info">${trip.departureTime} · ${trip.departureTerminal}</div>
                            </div>
                            <div class="route-separator">
                                <span>|</span>
                                <div class="route-line"></div>
                                <span>v</span>
                            </div>
                            <div class="route-points">
                                <div class="arrival">${trip.arrival}</div>
                                <div class="time-info">${trip.arrivalTime}</div>
                            </div>
                        </div>
                        <div class="trip-meta">
                            <div>Bus: ${trip.busType}</div>
                            <div>Ticket: ${trip.id}</div>
                            <div>Passengers: ${trip.seatsBooked}</div>
                            <div>Price: ${trip.ticketPrice}</div>
                        </div>
                    </div>
                    <div class="trip-actions">
                        ${trip.status === 'completed' ? 
                            `<button class="btn btn-primary rebook-btn">Book Similar Trip</button>
                             <button class="btn btn-secondary">Download Ticket</button>` : 
                          trip.status === 'upcoming' ? 
                            `<button class="btn btn-primary">View Ticket</button>
                             <button class="btn btn-secondary">Cancel Trip</button>` :
                            `<button class="btn btn-primary rebook-btn">Rebook Trip</button>`
                        }
                    </div>
                `;
                
                tripsList.appendChild(tripItem);
            });
        }
        
        // Function to load favorite routes
        function loadFavoriteRoutes() {
            const favoritesList = document.getElementById('favorites-list');
            
            // Get favorites from localStorage or use sample data
            let favorites = JSON.parse(localStorage.getItem('postBusFavorites')) || [];
            
            if (favorites.length === 0) {
                // Sample favorite data
                favorites = [
                    {
                        id: 1,
                        departure: "Lilongwe",
                        arrival: "Blantyre",
                        frequency: 5
                    },
                    {
                        id: 2,
                        departure: "Blantyre",
                        arrival: "Lilongwe",
                        frequency: 3
                    },
                    {
                        id: 3,
                        departure: "Lilongwe",
                        arrival: "Mzuzu",
                        frequency: 2
                    }
                ];
                localStorage.setItem('postBusFavorites', JSON.stringify(favorites));
            }
            
            // Sort by frequency (most frequent first)
            favorites.sort((a, b) => b.frequency - a.frequency);
            
            // Clear existing content
            favoritesList.innerHTML = '';
            
            // Check if there are any favorites
            if (favorites.length === 0) {
                favoritesList.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-state-icon">⭐</div>
                        <div class="empty-state-text">You haven't saved any favorite routes yet</div>
                    </div>
                `;
                return;
            }
            
            // Render favorite items
            favorites.forEach(favorite => {
                const favoriteItem = document.createElement('div');
                favoriteItem.className = 'favorite-item';
                favoriteItem.dataset.id = favorite.id;
                
                favoriteItem.innerHTML = `
                    <div class="favorite-route">${favorite.departure} to ${favorite.arrival}</div>
                    <div class="favorite-details">Booked ${favorite.frequency} times</div>
                    <div class="favorite-actions">
                        <button class="icon-btn book-btn">📅</button>
                        <button class="icon-btn delete-btn">🗑️</button>
                    </div>
                    ${favorite.frequency > 4 ? `<div class="favorite-badge">⭐</div>` : ''}
                `;
                
                favoritesList.appendChild(favoriteItem);
            });
            
            // Add event listeners for delete buttons
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const favoriteItem = this.closest('.favorite-item');
                    const favoriteId = parseInt(favoriteItem.dataset.id);
                    
                    // Remove from favorites
                    deleteFavoriteRoute(favoriteId);
                    
                    // Remove from DOM
                    favoriteItem.remove();
                    
                    // Show notification
                    showNotification('Route removed from favorites');
                    
                    // Reload favorites
                    loadFavoriteRoutes();
                });
            });
        }
        
        // Function to add a favorite route
        function addFavoriteRoute(departure, destination) {
            // Get existing favorites
            let favorites = JSON.parse(localStorage.getItem('postBusFavorites')) || [];
            
            // Check if route already exists
            const existingRoute = favorites.find(route => 
                route.departure === departure && route.arrival === destination
            );
            
            if (existingRoute) {
                // Increment frequency
                existingRoute.frequency += 1;
            } else {
                // Create new favorite
                const newId = favorites.length > 0 ? Math.max(...favorites.map(f => f.id)) + 1 : 1;
                favorites.push({
                    id: newId,
                    departure: departure,
                    arrival: destination,
                    frequency: 1
                });
            }
            
            // Save to localStorage
            localStorage.setItem('postBusFavorites', JSON.stringify(favorites));
        }
        
        // Function to delete a favorite route
        function deleteFavoriteRoute(favoriteId) {
            // Get existing favorites
            let favorites = JSON.parse(localStorage.getItem('postBusFavorites')) || [];
            
            // Filter out the deleted favorite
            favorites = favorites.filter(route => route.id !== favoriteId);
            
            // Save to localStorage
            localStorage.setItem('postBusFavorites', JSON.stringify(favorites));
        }
        
        // Function to book a trip
        function bookTrip(departure, destination, travelDate) {
            // Get existing trips
            let trips = JSON.parse(localStorage.getItem('postBusTrips')) || [];
            
            // Generate ticket ID
            const ticketId = "PB" + (123461 + trips.length + 1);
            
            // Add new trip
            const newTrip = {
                id: ticketId,
                departure: departure,
                arrival: destination,
                departureDate: travelDate,
                departureTime: "08:00",
                arrivalTime: calculateArrivalTime(departure, destination, "08:00"),
                status: "upcoming",
                busType: document.getElementById('bus-class').value.charAt(0).toUpperCase() + document.getElementById('bus-class').value.slice(1),
                seatsBooked: parseInt(document.getElementById('passengers').value),
                ticketPrice: calculateTicketPrice(departure, destination, document.getElementById('bus-class').value),
                departureTerminal: "Main Terminal"
            };
            
            // Add to trips
            trips.push(newTrip);
            
            // Save to localStorage
            localStorage.setItem('postBusTrips', JSON.stringify(trips));
            
            // Add to favorites (with lower frequency)
            addFavoriteRoute(departure, destination);
        }
        
        // Function to show a notification
        function showNotification(message) {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.style.display = 'block';
            
            // Fade in
            setTimeout(() => {
                notification.style.opacity = 1;
            }, 10);
            
            // Fade out after 3 seconds
            setTimeout(() => {
                notification.style.opacity = 0;
                
                // Hide after fade out
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 300);
            }, 3000);
        }
        
        // Helper function to calculate arrival time
        function calculateArrivalTime(departure, destination, departureTime) {
            // Simple calculation based on average travel times
            const routes = {
                "Lilongwe-Blantyre": 270, // 4h30m in minutes
                "Blantyre-Lilongwe": 270,
                "Lilongwe-Mzuzu": 240, // 4h in minutes
                "Mzuzu-Lilongwe": 240,
                "Blantyre-Zomba": 60, // 1h in minutes
                "Zomba-Blantyre": 60,
                "Lilongwe-Kasungu": 90, // 1h30m in minutes
                "Kasungu-Lilongwe": 90
            };
            
            const route = `${departure}-${destination}`;
            const travelTime = routes[route] || 180; // Default to 3h if route not found
            
            // Parse departure time
            const [hours, minutes] = departureTime.split(':').map(Number);
            
            // Calculate arrival time
            let arrivalHours = hours + Math.floor((minutes + travelTime) / 60);
            const arrivalMinutes = (minutes + travelTime) % 60;
            
            // Format arrival time
            return `${String(arrivalHours % 24).padStart(2, '0')}:${String(arrivalMinutes).padStart(2, '0')}`;
        }
        
        // Helper function to calculate ticket price
        function calculateTicketPrice(departure, destination, busClass) {
            // Base prices for routes
            const basePrice = {
                "Lilongwe-Blantyre": 7000,
                "Blantyre-Lilongwe": 7000,
                "Lilongwe-Mzuzu": 8000,
                "Mzuzu-Lilongwe": 8000,
                "Blantyre-Zomba": 3000,
                "Zomba-Blantyre": 3000,
                "Lilongwe-Kasungu": 4000,
                "Kasungu-Lilongwe": 4000
            };
            
            // Multipliers for bus class
            const classMultiplier = {
                "standard": 1,
                "express": 1.2,
                "luxury": 1.5
            };
            
            const route = `${departure}-${destination}`;
            const price = (basePrice[route] || 5000) * (classMultiplier[busClass] || 1);
            
            // Format price
            return `MWK ${price.toLocaleString()}`;
        }
    </script>
</body>
</html>