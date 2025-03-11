<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>POST COACH Timetables & Fares</title>
    <style>
      
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
    
    <div class="containe">
        <h2>POST COACH Timetables & Fares</h2>
        
        <div class="route-selector">
            <button onclick="showRoute('blantyre-mzuzu')">Blantyre to Mzuzu</button>
            <button onclick="showRoute('mzuzu-blantyre')">Mzuzu to Blantyre</button>
            <button onclick="showRoute('mzuzu-karonga')">Mzuzu to Karonga</button>
            <button onclick="showRoute('karonga-mzuzu')">Karonga to Mzuzu</button>
            <button onclick="showRoute('lilongwe-blantyre')">Lilongwe to Blantyre</button>
        </div>

        <div id="routes">
            <div id="blantyre-mzuzu" class="route-section">
                <h2>From Blantyre to Mzuzu via Lilongwe</h2>
                <table>
                    <tr>
                        <th>Route Stops</th>
                        <th>Booking Deadline</th>
                        <th>Departure Time</th>
                        <th>Fare (MK)</th>
                    </tr>
                    <tr><td>Zalewa</td><td>18:00</td><td>18:30</td><td>5,000</td></tr>
                    <tr><td>Chingeni</td><td>18:00</td><td>18:30</td><td>7,000</td></tr>
                    <tr><td>Ntcheu</td><td>18:00</td><td>18:30</td><td>8,000</td></tr>
                    <tr><td>Dedza</td><td>18:00</td><td>18:30</td><td>12,000</td></tr>
                    <tr><td>Lilongwe</td><td>18:00</td><td>18:30</td><td>14,000</td></tr>
                    <tr><td>Kasungu</td><td>18:00</td><td>18:30</td><td>20,000</td></tr>
                    <tr><td>Jenda</td><td>18:00</td><td>18:30</td><td>22,000</td></tr>
                    <tr><td>Mzimba</td><td>18:00</td><td>18:30</td><td>23,000</td></tr>
                    <tr><td>Mzuzu</td><td>18:00</td><td>18:30</td><td>25,000</td></tr>
                </table>
            </div>

            <div id="mzuzu-blantyre" class="route-section" style="display:none;">
                <h2>From Mzuzu to Blantyre via Lilongwe</h2>
                <table>
                    <tr>
                        <th>Route Stops</th>
                        <th>Booking Deadline</th>
                        <th>Departure Time</th>
                        <th>Fare (MK)</th>
                    </tr>
                    <tr><td>Mzimba</td><td>18:00</td><td>18:30</td><td>7,000</td></tr>
                    <tr><td>Jenda</td><td>18:00</td><td>18:30</td><td>10,000</td></tr>
                    <tr><td>Kasungu</td><td>18:00</td><td>18:30</td><td>13,000</td></tr>
                    <tr><td>Lilongwe</td><td>18:00</td><td>18:30</td><td>15,000</td></tr>
                    <tr><td>Dedza</td><td>18:00</td><td>18:30</td><td>17,000</td></tr>
                    <tr><td>Ntcheu</td><td>18:00</td><td>18:30</td><td>18,000</td></tr>
                    <tr><td>Chingeni</td><td>18:00</td><td>18:30</td><td>20,000</td></tr>
                    <tr><td>Zalewa</td><td>18:00</td><td>18:30</td><td>23,000</td></tr>
                    <tr><td>Blantyre</td><td>18:00</td><td>18:30</td><td>25,000</td></tr>
                </table>
            </div>

            <div id="mzuzu-karonga" class="route-section" style="display:none;">
                <h2>From Mzuzu to Karonga</h2>
                <table>
                    <tr>
                        <th>Route Stops</th>
                        <th>Booking Deadline</th>
                        <th>Departure Time</th>
                        <th>Fare (MK)</th>
                    </tr>
                    <tr><td>Ekwendeni</td><td>5:30</td><td>6:00</td><td>2,000</td></tr>
                    <tr><td>Bwengu</td><td>5:30</td><td>6:00</td><td>4,000</td></tr>
                    <tr><td>Phwezi</td><td>5:30</td><td>6:00</td><td>5,000</td></tr>
                    <tr><td>Chiweta</td><td>5:30</td><td>6:00</td><td>6,000</td></tr>
                    <tr><td>Chitimba</td><td>5:30</td><td>6:00</td><td>7,500</td></tr>
                    <tr><td>Uliwa</td><td>5:30</td><td>6:00</td><td>8,000</td></tr>
                    <tr><td>Karonga</td><td>5:30</td><td>6:00</td><td>9,000</td></tr>
                </table>
            </div>

            <div id="karonga-mzuzu" class="route-section" style="display:none;">
                <h2>From Karonga to Mzuzu</h2>
                <table>
                    <tr>
                        <th>Route Stops</th>
                        <th>Booking Deadline</th>
                        <th>Departure Time</th>
                        <th>Fare (MK)</th>
                    </tr>
                    <tr><td>Uliwa</td><td>12:30</td><td>13:00</td><td>2,000</td></tr>
                    <tr><td>Chitimba</td><td>12:30</td><td>13:00</td><td>4,000</td></tr>
                    <tr><td>Chiweta</td><td>12:30</td><td>13:00</td><td>4,500</td></tr>
                    <tr><td>Phwezi</td><td>12:30</td><td>13:00</td><td>8,000</td></tr>
                    <tr><td>Bwengu</td><td>12:30</td><td>13:00</td><td>8,500</td></tr>
                    <tr><td>Ekwendeni</td><td>12:30</td><td>13:00</td><td>9,000</td></tr>
                    <tr><td>Mzuzu</td><td>12:30</td><td>13:00</td><td>9,000</td></tr>
                </table>
            </div>

            <div id="lilongwe-blantyre" class="route-section" style="display:none;">
                <h2>From Lilongwe to Blantyre</h2>
                <table>
                    <tr>
                        <th>Route Stops</th>
                        <th>Booking Deadline</th>
                        <th>Departure Time</th>
                        <th>Fare (MK)</th>
                    </tr>
                    <tr><td>Dedza</td><td>23:00</td><td>23:30</td><td>Included</td></tr>
                    <tr><td>Ntcheu</td><td>23:00</td><td>23:30</td><td>Included</td></tr>
                    <tr><td>Chingeni</td><td>23:00</td><td>23:30</td><td>Included</td></tr>
                    <tr><td>Zalewa</td><td>23:00</td><td>23:30</td><td>Included</td></tr>
                    <tr><td>Blantyre</td><td>23:00</td><td>23:30</td><td>Included</td></tr>
                </table>
            </div>
        </div>

        <div class="section contacts">
            <div class="contact-info">
                <h3>Lilongwe Office</h3>
                <p>Location: Area 3, Post Office, Lilongwe</p>
                <p>Phone: +265 (0) 994 168 157</p>
            </div>
            <div class="contact-info">
                <h3>Blantyre Office</h3>
                <p>Location: Chichiri Post Office, Along Chichiri Ginnery Corner, Blantyre</p>
                <p>Phone: +265 (0) 994 168 158</p>
            </div>
            <div class="contact-info">
                <h3>Mzuzu Office</h3>
                <p>Location: Mzuzu Post Office, Near Kanjedza Drive, Mzuzu</p>
                <p>Phone: +265 (0) 994 168 154</p>
            </div>
        </div>

        <p style="text-align:center; color:#888;">Schedules and Fares as of April 2023</p>
    </div>
    <div class="back-to-top" id="backToTop" onclick="scrollToTop()">
        <i class="fas fa-arrow-up"></i>
    </div>
    
    <footer class="footer">
        <div class="footer-links">
            <a href="about .php" class="footer-link">About Us</a>
            <a href="privacy.php" class="footer-link">Terms $ Privacy</a>
            <a href="#" class="footer-link">Privacy</a>
            <a href="fao.php" class="footer-link">FAQs</a>
            <a href="contact.php" class="footer-link">Contact</a>
        </div>
        <div class="copyright">
            © 2025 Post Bus Malawi. All rights reserved.
       
    </footer>
    
    <script src="java.js"></script>
    <script src="script.js"></script>
    <script>
        function showRoute(routeId) {
            // Hide all route sections
            const routeSections = document.querySelectorAll('.route-section');
            routeSections.forEach(section => {
                section.style.display = 'none';
            });

            // Deactivate all buttons
            const buttons = document.querySelectorAll('.route-selector button');
            buttons.forEach(button => {
                button.classList.remove('active');
            });

            // Show selected route section
            const selectedRoute = document.getElementById(routeId);
            selectedRoute.style.display = 'block';

            // Activate selected button
            const selectedButton = document.querySelector(`button[onclick="showRoute('${routeId}')"]`);
            selectedButton.classList.add('active');
        }

        // Set default route on page load
        document.addEventListener('DOMContentLoaded', () => {
            showRoute('blantyre-mzuzu');
        });
    </script>
</body>
</html>