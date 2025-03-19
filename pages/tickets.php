<?php
$page_name = 'tickets page';  // Set the current page name
include('../pages/header.php');
?>
<body>
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
    <script src="../script/java.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>  
    <script src="../script/script.js"></script> 
    <script src="../script/fao.js"></script> 
</body>
</html>