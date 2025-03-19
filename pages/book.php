<?php
$page_name = 'booking history';  // Set the current page name
include('../pages/header.php');
?>
        <div class="cont">
        <div class="overlay" id="overlay"></div>
        <div class="hero">
            <h2>Frequently Asked Questions</h2>
            <p>Find answers to common questions about Post Bus Malawi services</p>
        </div> 
        <div class="search-container">
                <input type="text" placeholder="Search FAQs..." class="search-input" id="searchInput">
                <button class="search-btn" id="searchBtn">🔍</button>
            </div>

        <div class="main-content">
            <div class="quick-links">
            <a href="fao.php" class="quick-link active">All</a>
                <a href="book.php"><button class="quick-link">Booking</button></a>
                <a href="tickets.php"><button class="quick-link">Tickets</button></a>
                <a href="schedul.php"><button class="quick-link">Schedules</button></a>
                <a href="luggage.php"><button class="quick-link">Luggage</button></a>
                <a href="refunds.php"><button class="quick-link">Refunds</button></a>

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
            <div class="cta-section">
                <h3>Still have questions?</h3>
                <p>Our customer service team is ready to assist you with any other inquiries.</p>
                <a href="contact.php" class="cta-btn">Contact Us</a>
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
        <?php
include('../pages/footer.php');  // Include footer.php
?>
    </div>
    <script src="../script/java.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>  
    <script src="../script/script.js"></script> 
    <script src="../script/fao.js"></script> 
</body>
</html>
