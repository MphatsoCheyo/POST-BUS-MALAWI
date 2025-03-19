<?php
$page_name = 'index';  // Set the current page name
include('../pages/header.php');
?>
    <div class="container">
        <div class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" id="searchInput" placeholder="Search routes, cities, or buses...">
            <div class="search-results" id="searchResults"></div>
        </div>
        <h2>WELCOME TO POST BUS MALAWI APP</h2>

        <div class="swim-slider">
    <div class="swim-slides" id="swimSlides">
        <div class="swim-slide">
            <img src="../images/1.jpeg" alt="Reliable Nationwide Travel">
            <div class="swim-slide-overlay">
                <div class="swim-slide-title">Reliable Nationwide Travel</div>
                <div class="swim-slide-description">Experience safe, affordable, and convenient travel across Malawi with Post Bus Malawi.</div>
            </div>
        </div>
        <div class="swim-slide">
            <img src="../images/2.jpeg" alt="Comfortable & Modern Buses">
            <div class="swim-slide-overlay">
                <div class="swim-slide-title">Comfortable & Modern Buses</div>
                <div class="swim-slide-description">Travel in style with spacious seating, air conditioning, and on-board Wi-Fi.</div>
            </div>
        </div>
        <div class="swim-slide">
            <img src="../images/5.jpeg" alt="Timely & Efficient Service">
            <div class="swim-slide-overlay">
                <div class="swim-slide-title">Timely & Efficient Service</div>
                <div class="swim-slide-description">We ensure punctual departures and reliable schedules for your journey.</div>
            </div>
        </div>
        <div class="swim-slide">
            <img src="../images/4.jpeg" alt="Secure & Hassle-Free Booking">
            <div class="swim-slide-overlay">
                <div class="swim-slide-title">Secure & Hassle-Free Booking</div>
                <div class="swim-slide-description">Book your tickets online with ease and enjoy a seamless travel experience.</div>
            </div>
        </div>
    </div>

    <!-- Slide Indicators -->
    <div class="swim-slide-indicators">
        <div class="swim-slide-indicator active" data-slide="0"></div>
        <div class="swim-slide-indicator" data-slide="1"></div>
        <div class="swim-slide-indicator" data-slide="2"></div>
        <div class="swim-slide-indicator" data-slide="3"></div>
    </div>
</div>

        
        <!-- Promotional Banners -->
        <div class="promo-container">
            <!-- Lilongwe Promotion -->
            <div class="promo-banner" id="lilongwePromo" data-location="Lilongwe">
                <div class="promo-banner-content">
                    <div class="promo-icon">
                        <i class="fas fa-gift"></i>
                    </div>
                    <div class="promo-text">
                        <h3 class="promo-title">Weekend Special: Lilongwe to Blantyre</h3>
                        <p class="promo-details">Get 20% off on all weekend trips from Lilongwe to Blantyre. Valid until March 31st!</p>
                        <button class="promo-cta">Book Now</button>
                    </div>
                </div>
                <div class="location-indicator">Lilongwe</div>
            </div>
            
            <!-- Blantyre Promotion -->
            <div class="promo-banner" id="blantyrePromo" data-location="Blantyre">
                <div class="promo-banner-content">
                    <div class="promo-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="promo-text">
                        <h3 class="promo-title">New Premium Bus Service: Blantyre to Mzuzu</h3>
                        <p class="promo-details">Experience our new luxury coaches with free Wi-Fi, USB charging, and refreshments!</p>
                        <button class="promo-cta">Learn More</button>
                    </div>
                </div>
                <div class="location-indicator">Blantyre</div>
            </div>
            
            <!-- Mzuzu Promotion -->
            <div class="promo-banner" id="mzuzuPromo" data-location="Mzuzu">
                <div class="promo-banner-content">
                    <div class="promo-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="promo-text">
                        <h3 class="promo-title">Early Bird Discount: Mzuzu Routes</h3>
                        <p class="promo-details">Book any Mzuzu route 7 days in advance and receive a 15% discount on your fare!</p>
                        <button class="promo-cta">Book Now</button>
                    </div>
                </div>
                <div class="location-indicator">Mzuzu</div>
            </div>
            
            <!-- Zomba Promotion -->
            <div class="promo-banner" id="zombaPromo" data-location="Zomba">
                <div class="promo-banner-content">
                    <div class="promo-icon">
                        <i class="fas fa-bus"></i>
                    </div>
                    <div class="promo-text">
                        <h3 class="promo-title">New Route: Zomba to Salima</h3>
                        <p class="promo-details">Introducing our new direct route from Zomba to Salima. Introductory fares starting at MK 8,000!</p>
                        <button class="promo-cta">View Schedule</button>
                    </div>
                </div>
                <div class="location-indicator">Zomba</div>
            </div>
            
            <!-- Seasonal Promotion (all locations) -->
            <div class="promo-banner active" id="seasonalPromo">
                <div class="promo-banner-content">
                    <div class="promo-icon">
                        <i class="fas fa-percent"></i>
                    </div>
                    <div class="promo-text">
                        <h3 class="promo-title">March Madness: 25% Off All Routes!</h3>
                        <p class="promo-details">Limited time offer! Book any route before March 15th and get 25% off your fare. Use code MARCH25 at checkout.</p>
                        <button class="promo-cta">Apply Discount</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="quick-access">
            <div class="quick-btn">
                <i class="fas fa-ticket-alt"></i>
                <span><a href="booking.php">Book a Ticket</a></span>
            </div>
            <div class="quick-btn">
                <i class="fas fa-chair"></i>
                <span><a href="seat.php">Select a Seat</a></span>
            </div>
            <div class="quick-btn">
                <i class="fas fa-clock"></i>
                <span><a href="schedule.php">Check Schedules</a></span>
            </div>
            <div class="quick-btn">
                <i class="fas fa-credit-card"></i>
                <span><a href="payment.php">Payment Options</a></span>
            </div>
            <div class="quick-btn">
            <i class="fas fa-qrcode"></i> 
                <span><a href="qrcode.php">QR Code Generation</a></span>
            </div>
            <div class="quick-btn">
                <i class="fas fa-bus"></i>
                <span><a href="tracking.php">Track a Bus</a></span>
            </div>
            
        </div>
        
        <h2 class="section-title">Popular Routes</h2>
        <div class="featured-routes">
            <div class="route-card">
                <div class="route-info">
                    <div class="route-cities">Lilongwe → Blantyre</div>
                    <div class="route-price">MK 25,000</div>
                </div>
                <div class="route-schedule">
                    <i class="far fa-clock"></i> Daily: 06:00, 10:00, 14:00
                </div>
                <div class="route-details">
                    <span><i class="fas fa-road"></i> 350 km</span>
                    <span><i class="fas fa-clock"></i> 4.5 hours</span>
                    <span><i class="fas fa-couch"></i> Executive</span>
                </div>
            </div>
            
            <div class="route-card">
                <div class="route-info">
                    <div class="route-cities">Blantyre → Mzuzu</div>
                    <div class="route-price">MK 65,000</div>
                </div>
                <div class="route-schedule">
                    <i class="far fa-clock"></i> Daily: 05:30, 09:00, 13:30
                </div>
                <div class="route-details">
                    <span><i class="fas fa-road"></i> 520 km</span>
                    <span><i class="fas fa-clock"></i> 8 hours</span>
                    <span><i class="fas fa-couch"></i> Premium</span>
                </div>
            </div>
            
            <div class="route-card">
                <div class="route-info">
                    <div class="route-cities">Zomba → Lilongwe</div>
                    <div class="route-price">MK 20,000</div>
                </div>
                <div class="route-schedule">
                    <i class="far fa-clock"></i> Daily: 07:00, 11:00, 15:00
                </div>
                <div class="route-details">
                    <span><i class="fas fa-road"></i> 300 km</span>
                    <span><i class="fas fa-clock"></i> 3.5 hours</span>
                    <span><i class="fas fa-couch"></i> Standard</span>
                </div>
            </div>
        </div>
    </div>
    </div>
    
    <?php
    include('../pages/footer.php');  // Include footer.php
    ?>
    
    <script src="../script/script.js"></script>
    <script>
        
        document.addEventListener('DOMContentLoaded', () => {
            // Slider functionality
            const swimSlides = document.getElementById('swimSlides');
            const indicators = document.querySelectorAll('.swim-slide-indicator');
            let currentSlide = 0;
            const totalSlides = indicators.length;

            function changeSlide(newSlide) {
                swimSlides.style.transform = `translateX(-${newSlide * 100}%)`;
                indicators.forEach(indicator => indicator.classList.remove('active'));
                indicators[newSlide].classList.add('active');
                currentSlide = newSlide;
            }

            function nextSlide() {
                let nextSlideIndex = (currentSlide + 1) % totalSlides;
                changeSlide(nextSlideIndex);
            }

            // Auto slide every 3 seconds
            setInterval(nextSlide, 3000);

            // Add click event to indicators
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => changeSlide(index));
            });

            // Back to top button functionality
            const backToTopButton = document.getElementById('backToTop');
            
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    backToTopButton.classList.add('visible');
                } else {
                    backToTopButton.classList.remove('visible');
                }
            });
            
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const searchResults = document.getElementById('searchResults');
            
            // Sample search data - this would typically come from a database
            const searchData = [
                { type: 'route', name: 'Lilongwe to Blantyre', url: 'booking.php?from=Lilongwe&to=Blantyre' },
                { type: 'route', name: 'Blantyre to Mzuzu', url: 'booking.php?from=Blantyre&to=Mzuzu' },
                { type: 'route', name: 'Zomba to Lilongwe', url: 'booking.php?from=Zomba&to=Lilongwe' },
                { type: 'route', name: 'Mzuzu to Blantyre', url: 'booking.php?from=Mzuzu&to=Blantyre' },
                { type: 'route', name: 'Lilongwe to Mzuzu', url: 'booking.php?from=Lilongwe&to=Mzuzu' },
                { type: 'route', name: 'Zomba to Salima', url: 'booking.php?from=Zomba&to=Salima' },
                { type: 'city', name: 'Lilongwe', url: 'city.php?name=Lilongwe' },
                { type: 'city', name: 'Blantyre', url: 'city.php?name=Blantyre' },
                { type: 'city', name: 'Mzuzu', url: 'city.php?name=Mzuzu' },
                { type: 'city', name: 'Zomba', url: 'city.php?name=Zomba' },
                { type: 'city', name: 'Salima', url: 'city.php?name=Salima' },
                { type: 'bus', name: 'Express Coach', url: 'bus.php?type=Express' },
                { type: 'bus', name: 'Premium Bus', url: 'bus.php?type=Premium' },
                { type: 'bus', name: 'Standard Coach', url: 'bus.php?type=Standard' },
                { type: 'bus', name: 'Executive Bus', url: 'bus.php?type=Executive' }
            ];
            
            searchInput.addEventListener('input', () => {
                const query = searchInput.value.toLowerCase().trim();
                
                if (query.length < 2) {
                    searchResults.style.display = 'none';
                    return;
                }
                
                const filteredResults = searchData.filter(item => 
                    item.name.toLowerCase().includes(query)
                );
                
                // Display results
                searchResults.innerHTML = '';
                
                if (filteredResults.length === 0) {
                    searchResults.innerHTML = '<div class="no-results">No results found</div>';
                } else {
                    filteredResults.forEach(result => {
                        const resultItem = document.createElement('div');
                        resultItem.className = 'search-result-item';
                        
                        let icon = '';
                        if (result.type === 'route') {
                            icon = '<i class="fas fa-route"></i>';
                        } else if (result.type === 'city') {
                            icon = '<i class="fas fa-city"></i>';
                        } else if (result.type === 'bus') {
                            icon = '<i class="fas fa-bus"></i>';
                        }
                        
                        resultItem.innerHTML = `${icon} ${result.name}`;
                        
                        resultItem.addEventListener('click', () => {
                            window.location.href = result.url;
                        });
                        
                        searchResults.appendChild(resultItem);
                    });
                }
                
                searchResults.style.display = 'block';
            });
            
            // Hide search results when clicking outside
            document.addEventListener('click', (event) => {
                if (!searchInput.contains(event.target) && !searchResults.contains(event.target)) {
                    searchResults.style.display = 'none';
                }
            });
        });
        
        // Function to scroll back to top
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
        
        // Logout function (placeholder)
        function logout() {
            // Add actual logout functionality here
            alert('Logging out...');
            // window.location.href = 'logout.php';
        }
        
        // Toggle navigation drawer
        function toggleNav() {
            const navDrawer = document.getElementById('navDrawer');
            navDrawer.classList.toggle('open');
        }
    </script>

</body>
</html>