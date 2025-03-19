<?php
$page_name = 'refunds page';  // Set the current page name
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