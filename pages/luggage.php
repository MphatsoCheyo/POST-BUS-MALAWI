<?php
$page_name = 'luggage';  // Set the current page name
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
