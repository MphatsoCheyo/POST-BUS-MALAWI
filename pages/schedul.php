<?php
$page_name = 'schedules';  // Set the current page name
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