<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Post Bus Malawi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<body>
    <div>
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
        <div class="cont">
        <div class="overlay" id="overlay"></div>
        <div class="hero">
            <h2>Frequently Asked Questions</h2>
            <p>Find answers to common questions about Post Bus Malawi services</p>
            <div class="search-container">
                <input type="text" placeholder="Search FAQs..." class="search-input" id="searchInput">
                <button class="search-btn" id="searchBtn">🔍</button>
            </div>
        </div>

        <div class="main-content">
            <div class="quick-links">
                <button class="quick-link active" data-category="all">All</button>
                <button class="quick-link" data-category="booking">Booking</button>
                <button class="quick-link" data-category="tickets">Tickets</button>
                <button class="quick-link" data-category="schedules">Schedules</button>
                <button class="quick-link" data-category="luggage">Luggage</button>
                <button class="quick-link" data-category="refunds">Refunds</button>
            </div>

            <div class="faq-section">
                <h2 class="section-title">Booking Information</h2>
                <div class="faq-container" data-category="booking">
                    <div class="faq-item">
                        <div class="faq-question" data-toggle="answer1">
                            How can I book a ticket with Post Bus Malawi?
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="faq-answer" id="answer1">
                            <p>You can book a ticket with Post Bus Malawi through multiple channels:</p>
                            <ul>
                                <li>Online through our official website</li>
                                <li>Using the Post Bus Malawi mobile app</li>
                                <li>Visiting any Post Bus Malawi terminal in person</li>
                                <li>At authorized Post Malawi offices across the country</li>
                                <li>By calling our customer service number: +265 1 234 5678</li>
                            </ul>
                            <p>For online bookings, payments can be made using credit/debit cards, mobile money (TNM Mpamba or Airtel Money), or bank transfers.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-toggle="answer2">
                            How far in advance can I book a ticket?
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="faq-answer" id="answer2">
                            <p>Tickets can be booked up to 30 days in advance. We recommend booking at least 2-3 days before your travel date, especially for weekend travel and during holiday seasons to ensure availability.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-toggle="answer3">
                            What information do I need to provide when booking?
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="faq-answer" id="answer3">
                            <p>When booking a ticket, you'll need to provide:</p>
                            <ul>
                                <li>Full name (as it appears on your ID)</li>
                                <li>Contact phone number</li>
                                <li>Email address (for e-tickets)</li>
                                <li>Travel date and route</li>
                                <li>Number of passengers</li>
                                <li>ID type and number (National ID, passport, or driver's license)</li>
                            </ul>
                            <p>For children under 16, a parent or guardian's ID is required.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="faq-section">
                <h2 class="section-title">Tickets and Fares</h2>
                <div class="faq-container" data-category="tickets">
                    <div class="faq-item">
                        <div class="faq-question" data-toggle="answer4">
                            What types of tickets does Post Bus Malawi offer?
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="faq-answer" id="answer4">
                            <p>Post Bus Malawi offers several ticket types:</p>
                            <ul>
                                <li><strong>Standard Ticket:</strong> Regular seating with standard amenities</li>
                                <li><strong>Executive Ticket:</strong> Premium seating with extra legroom, WiFi, and refreshments</li>
                                <li><strong>Return Ticket:</strong> Round-trip tickets with a 5% discount</li>
                                <li><strong>Group Ticket:</strong> For 10+ passengers traveling together (10% discount)</li>
                                <li><strong>Frequent Traveler:</strong> Loyalty program with accumulated points and benefits</li>
                            </ul>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-toggle="answer5">
                            Are there discounts for children and seniors?
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="faq-answer" id="answer5">
                            <p>Yes, we offer the following discounts:</p>
                            <ul>
                                <li>Children under 3 years: Free (when sharing a seat with an adult)</li>
                                <li>Children aged 3-12 years: 30% discount on regular fare</li>
                                <li>Senior citizens (65+): 20% discount (ID required)</li>
                                <li>Students with valid ID: 15% discount on weekday travel</li>
                            </ul>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-toggle="answer6">
                            How can I pay for my ticket?
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="faq-answer" id="answer6">
                            <p>We accept multiple payment methods:</p>
                            <ul>
                                <li>Cash (at terminals and offices)</li>
                                <li>Credit/Debit cards (Visa, MasterCard)</li>
                                <li>Mobile money (TNM Mpamba and Airtel Money)</li>
                                <li>Bank transfers (for advance bookings)</li>
                                <li>Online payment platforms (PayPal)</li>
                            </ul>
                            <p>All online payments are secured with encryption technology to protect your financial information.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="faq-section">
                <h2 class="section-title">Schedules and Routes</h2>
                <div class="faq-container" data-category="schedules">
                    <div class="faq-item">
                        <div class="faq-question" data-toggle="answer7">
                            What routes does Post Bus Malawi operate?
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="faq-answer" id="answer7">
                            <p>Post Bus Malawi operates routes connecting all major cities and towns within Malawi, including:</p>
                            <ul>
                                <li>Lilongwe - Blantyre</li>
                                <li>Lilongwe - Mzuzu</li>
                                <li>Blantyre - Zomba</li>
                                <li>Mzuzu - Blantyre</li>
                                <li>Lilongwe - Mangochi</li>
                                <li>Blantyre - Monkey Bay</li>
                            </ul>
                            <p>We also offer international routes to neighboring countries:</p>
                            <ul>
                                <li>Lilongwe - Lusaka (Zambia)</li>
                                <li>Blantyre - Harare (Zimbabwe)</li>
                                <li>Mzuzu - Dar es Salaam (Tanzania)</li>
                            </ul>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-toggle="answer8">
                            How frequent are your bus services?
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="faq-answer" id="answer8">
                            <p>Our service frequency varies by route:</p>
                            <ul>
                                <li><strong>Major routes</strong> (Lilongwe-Blantyre, Lilongwe-Mzuzu): Multiple departures daily (typically 5-6 buses)</li>
                                <li><strong>Secondary routes:</strong> 1-3 departures daily</li>
                                <li><strong>International routes:</strong> 2-3 departures weekly</li>
                            </ul>
                            <p>During peak holiday seasons, we increase the frequency on popular routes.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-toggle="answer9">
                            What happens if my bus is delayed?
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="faq-answer" id="answer9">
                            <p>In case of delays:</p>
                            <ul>
                                <li>We notify customers via SMS and email if delays exceed 30 minutes</li>
                                <li>For delays over 2 hours, we offer refreshments at the terminal</li>
                                <li>For delays over 4 hours, we offer the option to reschedule for free or receive a full refund</li>
                                <li>In case of mechanical issues, we arrange alternative transportation as quickly as possible</li>
                            </ul>
                            <p>You can also check real-time updates on our mobile app or by calling our customer service.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="faq-section">
                <h2 class="section-title">Luggage Information</h2>
                <div class="faq-container" data-category="luggage">
                    <div class="faq-item">
                        <div class="faq-question" data-toggle="answer10">
                            How much luggage am I allowed to bring?
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="faq-answer" id="answer10">
                            <p>Each passenger is allowed:</p>
                            <ul>
                                <li>1 piece of hand luggage (max 7kg) to be kept inside the bus</li>
                                <li>2 pieces of check-in luggage (max 20kg each) to be stored in the luggage compartment</li>
                            </ul>
                            <p>Additional luggage can be transported at an extra charge of MWK 500 per kg, subject to space availability.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-toggle="answer11">
                            Can I transport special items or parcels?
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="faq-answer" id="answer11">
                            <p>Yes, Post Bus Malawi offers parcel and special item transportation services:</p>
                            <ul>
                                <li>Parcels can be sent on any of our routes without passenger accompaniment</li>
                                <li>Special items (electronics, fragile items) must be properly packaged</li>
                                <li>Maximum parcel weight: 30kg per item</li>
                                <li>Prohibited items: flammable materials, weapons, illegal substances, perishable foods</li>
                            </ul>
                            <p>For parcel services, visit any Post Bus Malawi terminal or Post Malawi office with your item, ID, and receiver's contact information.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-toggle="answer12">
                            What if my luggage is lost or damaged?
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="faq-answer" id="answer12">
                            <p>In the event of lost or damaged luggage:</p>
                            <ul>
                                <li>Report immediately to the bus driver or terminal staff before leaving the terminal</li>
                                <li>Fill out a luggage claim form with details of the items</li>
                                <li>Submit the form along with your luggage tag and ticket</li>
                                <li>Claims are processed within 7 working days</li>
                                <li>Compensation is provided based on our liability policy (up to MWK 50,000 per passenger)</li>
                            </ul>
                            <p>For valuable items, we recommend purchasing additional insurance coverage at the time of booking.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="faq-section">
                <h2 class="section-title">Cancellations and Refunds</h2>
                <div class="faq-container" data-category="refunds">
                    <div class="faq-item">
                        <div class="faq-question" data-toggle="answer13">
                            What is your cancellation policy?
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="faq-answer" id="answer13">
                            <p>Our cancellation policy is as follows:</p>
                            <ul>
                                <li>Cancellations made 48+ hours before departure: 90% refund</li>
                                <li>Cancellations made 24-48 hours before departure: 70% refund</li>
                                <li>Cancellations made 12-24 hours before departure: 50% refund</li>
                                <li>Cancellations made less than 12 hours before departure: 25% refund</li>
                                <li>No-shows: No refund</li>
                            </ul>
                            <p>Refunds are processed within 7-14 business days and returned to the original payment method.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-toggle="answer14">
                            Can I reschedule my ticket instead of cancelling?
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="faq-answer" id="answer14">
                            <p>Yes, you can reschedule your ticket subject to the following conditions:</p>
                            <ul>
                            <ul>
                                <li>Rescheduling 48+ hours before departure: Free of charge</li>
                                <li>Rescheduling 24-48 hours before departure: MWK 1,000 fee</li>
                                <li>Rescheduling 12-24 hours before departure: MWK 2,000 fee</li>
                                <li>Rescheduling less than 12 hours before departure: 30% of ticket price</li>
                            </ul>
                            <p>Tickets can only be rescheduled once and must be used within 30 days of the original travel date, subject to seat availability.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-toggle="answer15">
                            How do I request a refund?
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="faq-answer" id="answer15">
                            <p>To request a refund:</p>
                            <ul>
                                <li>For online bookings: Log into your account on our website or app and select "Request Refund" option</li>
                                <li>For tickets purchased at terminals: Visit any Post Bus Malawi terminal with your ticket and ID</li>
                                <li>For phone bookings: Call our customer service at +265 1 234 5678</li>
                                <li>All refund requests must include your booking reference number and reason for cancellation</li>
                            </ul>
                            <p>Refund processing may take 7-14 business days depending on your payment method.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cta-section">
                <h3>Still have questions?</h3>
                <p>Our customer service team is ready to assist you with any other inquiries.</p>
                <a href="#" class="cta-btn">Contact Us</a>
            </div>

            <div class="contact-info">
                <h3>Contact Information</h3>
                <div class="contact-item">
                    <div class="contact-icon">📞</div>
                    <div class="contact-details">
                        <h4>Phone</h4>
                        <p>+265 1 234 5678</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">✉️</div>
                    <div class="contact-details">
                        <h4>Email</h4>
                        <p>info@postbusmalawi.com</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">⏰</div>
                    <div class="contact-details">
                        <h4>Support Hours</h4>
                        <p>Monday-Saturday: 7:00 AM - 8:00 PM</p>
                        <p>Sunday: 8:00 AM - 5:00 PM</p>
                    </div>
                </div>
            </div>

                        <div class="route-map">
                <h3>Our Routes</h3>
                <div class="map-container">
                    <div id="map"></div>
                </div>
                <div class="popular-routes">
                    <span class="route-badge">Lilongwe - Blantyre</span>
                    <span class="route-badge">Mzuzu - Lilongwe</span>
                    <span class="route-badge">Blantyre - Zomba</span>
                    <span class="route-badge">Lilongwe - Mangochi</span>
                    <span class="route-badge">Mzuzu - Blantyre</span>
                </div>
            </div>
        </div>
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
    </div>
    <script src="java.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>  
    <script src="script.js"></script>   
   

    <script>
        
             document.addEventListener("DOMContentLoaded", function() {
        // Initialize the map
        const map = L.map('map').setView([-13.9631, 33.7741], 6); // Centered on Malawi

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Bus Route Markers
        const routes = [
            { name: "Lilongwe - Blantyre", coords: [-13.9631, 33.7741], desc: "Main intercity route." },
            { name: "Mzuzu - Lilongwe", coords: [-11.4500, 34.0194], desc: "Scenic northern route." },
            { name: "Blantyre - Zomba", coords: [-15.7861, 35.0058], desc: "Short route." },
            { name: "Lilongwe - Mangochi", coords: [-14.4781, 35.2637], desc: "Lake-side route." },
            { name: "Mzuzu - Blantyre", coords: [-16.0678, 34.8458], desc: "Long-distance route." }
        ];

        // Add markers for each route
        routes.forEach(route => {
            L.marker(route.coords)
                .addTo(map)
                .bindPopup(`<b>${route.name}</b><br>${route.desc}`);
        });
    });
        // JavaScript for FAQ toggling
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle FAQ answers
            const faqQuestions = document.querySelectorAll('.faq-question');
            faqQuestions.forEach(question => {
                question.addEventListener('click', function() {
                    const answerId = this.getAttribute('data-toggle');
                    const answer = document.getElementById(answerId);
                    
                    this.classList.toggle('active');
                    this.querySelector('.toggle-icon').classList.toggle('active');
                    answer.classList.toggle('active');
                });
            });

            // Quick links filtering
            const quickLinks = document.querySelectorAll('.quick-link');
            quickLinks.forEach(link => {
                link.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');
                    
                    // Remove active class from all links
                    quickLinks.forEach(link => link.classList.remove('active'));
                    
                    // Add active class to clicked link
                    this.classList.add('active');
                    
                    // Show all items if 'all' category is selected
                    if (category === 'all') {
                        document.querySelectorAll('.faq-container').forEach(container => {
                            container.parentElement.style.display = 'block';
                        });
                    } else {
                        // Hide all sections first
                        document.querySelectorAll('.faq-section').forEach(section => {
                            section.style.display = 'none';
                        });
                        
                        // Show only the sections with matching category
                        document.querySelectorAll(`.faq-container[data-category="${category}"]`).forEach(container => {
                            container.parentElement.style.display = 'block';
                        });
                    }
                });
            });

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const searchBtn = document.getElementById('searchBtn');
            
            searchBtn.addEventListener('click', performSearch);
            searchInput.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });
            
            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                
                if (searchTerm === '') {
                    // Reset all highlights
                    document.querySelectorAll('.highlight').forEach(el => {
                        el.classList.remove('highlight');
                    });
                    
                    // Show all sections
                    document.querySelectorAll('.faq-section').forEach(section => {
                        section.style.display = 'block';
                    });
                    
                    return;
                }
                
                // Show all sections
                document.querySelectorAll('.faq-section').forEach(section => {
                    section.style.display = 'block';
                });
                
                // Reset all highlights
                document.querySelectorAll('.highlight').forEach(el => {
                    el.classList.remove('highlight');
                });
                
                let foundResults = false;
                
                // Search through questions and answers
                document.querySelectorAll('.faq-item').forEach(item => {
                    const question = item.querySelector('.faq-question').textContent.toLowerCase();
                    const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
                    
                    if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                        foundResults = true;
                        
                        // Highlight matching text in question
                        const questionEl = item.querySelector('.faq-question');
                        questionEl.innerHTML = questionEl.innerHTML.replace(
                            new RegExp(searchTerm, 'gi'),
                            match => `<span class="highlight">${match}</span>`
                        );
                        
                        // Highlight matching text in answer
                        const answerEl = item.querySelector('.faq-answer');
                        answerEl.innerHTML = answerEl.innerHTML.replace(
                            new RegExp(searchTerm, 'gi'),
                            match => `<span class="highlight">${match}</span>`
                        );
                        
                        // Open the answer
                        item.querySelector('.faq-question').classList.add('active');
                        item.querySelector('.toggle-icon').classList.add('active');
                        item.querySelector('.faq-answer').classList.add('active');
                    }
                });
                
                if (!foundResults) {
                    alert('No results found for "' + searchTerm + '"');
                }
            }

            // Side menu functionality
            const menuBtn = document.getElementById('menuBtn');
            const menuClose = document.getElementById('menuClose');
            const sideMenu = document.getElementById('sideMenu');
            const overlay = document.getElementById('overlay');
            
            menuBtn.addEventListener('click', function() {
                sideMenu.classList.add('active');
                overlay.classList.add('active');
            });
            
            menuClose.addEventListener('click', function() {
                sideMenu.classList.remove('active');
                overlay.classList.remove('active');
            });
            
            overlay.addEventListener('click', function() {
                sideMenu.classList.remove('active');
                overlay.classList.remove('active');
            });

            // Back to top button
            const backToTop = document.getElementById('backToTop');
            
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTop.classList.add('active');
                } else {
                    backToTop.classList.remove('active');
                }
            });
            
            backToTop.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>