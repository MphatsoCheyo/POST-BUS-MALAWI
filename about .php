<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Post Bus Malawi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    
</head>
<body>
    <div class="conttainer">
        <div class="overlay" id="overlay"></div>

        <div class="hero">
            <h2>About Post Malawi</h2>
            <p>Connecting Malawi to the World Since 2000</p>
        </div>

        <section>
            <h2 class="section-title">Our Story</h2>
            <p>Post Malawi, operated by Malawi Corporation, is the nation's leading postal service provider. Since our establishment in 2000 following Malawi's independence, we have been committed to connecting Malawians to each other and to the world, providing reliable and efficient postal services across the country.</p>
            
            <div class="mission-vision">
                <div class="card">
                    <h3>Our Mission</h3>
                    <p>To provide efficient, reliable, and accessible postal services that connect people and businesses across Malawi and beyond, contributing to the socio-economic development of our nation.</p>
                </div>
                
                <div class="card">
                    <h3>Our Vision</h3>
                    <p>To be a world-class postal service that leverages innovation and technology to exceed customer expectations while maintaining the highest standards of reliability and accessibility.</p>
                </div>
            </div>
        </section>

        <section>
    <h2 class="section-title">Our History</h2>
    <div class="timeline">
        <div class="timeline-item">
            <h3>2000</h3>
            <p>Establishment of Post Malawi by Malawi Corporation.</p>
        </div>
        
        <div class="timeline-item">
            <h3>2005</h3>
            <p>Expanded services to all districts in Malawi, ensuring nationwide coverage.</p>
        </div>
        
        <div class="timeline-item">
            <h3>2010</h3>
            <p>Introduction of express mail services and international partnerships.</p>
        </div>
        
        <div class="timeline-item">
            <h3>2015</h3>
            <p>Modernization program launched, introducing computerized systems.</p>
        </div>
        
        <div class="timeline-item">
            <h3>2025</h3>
            <p>Launch of digital services including mobile app and online tracking.</p>
        </div>
    </div>
</section>

        <section>
            <h2 class="section-title">Leadership Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img src="/api/placeholder/300/300" alt="CEO">
                    <div class="team-member-info">
                        <h3>Dr. James Banda</h3>
                        <p>Chief Executive Officer</p>
                    </div>
                </div>
                
                <div class="team-member">
                    <img src="/api/placeholder/300/300" alt="COO">
                    <div class="team-member-info">
                        <h3>Sarah Mwanza</h3>
                        <p>Chief Operations Officer</p>
                    </div>
                </div>
                
                <div class="team-member">
                    <img src="/api/placeholder/300/300" alt="CFO">
                    <div class="team-member-info">
                        <h3>Patrick Phiri</h3>
                        <p>Chief Financial Officer</p>
                    </div>
                </div>
                
                <div class="team-member">
                    <img src="/api/placeholder/300/300" alt="CTO">
                    <div class="team-member-info">
                        <h3>Linda Chirwa</h3>
                        <p>Chief Technology Officer</p>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <h2 class="section-title">Post Malawi at a Glance</h2>
            <div class="stats-container">
                <div class="stat-box">
                    <h3>300+</h3>
                    <p>Post Offices</p>
                </div>
                
                <div class="stat-box">
                    <h3>5000+</h3>
                    <p>Employees</p>
                </div>
                
                <div class="stat-box">
                    <h3>60+</h3>
                    <p>Years of Service</p>
                </div>
                
                <div class="stat-box">
                    <h3>28</h3>
                    <p>Districts Covered</p>
                </div>
            </div>

            <div class="contact-info">
                <h3>Contact Us</h3>
                <div class="contact-item">
                    <div class="contact-icon">📍</div>
                    <div class="contact-text">
                        <h3>Headquarters</h3>
                        <p>123 Independence Avenue, Lilongwe, Malawi</p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">📞</div>
                    <div class="contact-text">
                        <h3>Phone</h3>
                        <p>+265 1 234 5678</p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">✉️</div>
                    <div class="contact-text">
                        <h3>Email</h3>
                        <p>info@postmalawi.mw</p>
                    </div>
                </div>
            </div>
        </section>
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
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.getElementById('menuBtn');
            const menuClose = document.getElementById('menuClose');
            const sideMenu = document.getElementById('sideMenu');
            const overlay = document.getElementById('overlay');
            const backToTop = document.getElementById('backToTop');

            // Menu toggle
            menuBtn.addEventListener('click', function() {
                sideMenu.classList.add('active');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            });

            menuClose.addEventListener('click', function() {
                sideMenu.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = 'auto';
            });

            overlay.addEventListener('click', function() {
                sideMenu.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = 'auto';
            });

            // Back to top button
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

            // Animate stats on scroll
            const statBoxes = document.querySelectorAll('.stat-box h3');
            const statsSection = document.querySelector('.stats-container');
            
            let animated = false;

            function animateStats() {
                if (animated) return;
                
                const sectionTop = statsSection.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                
                if (sectionTop < windowHeight - 100) {
                    statBoxes.forEach(stat => {
                        const target = parseInt(stat.textContent);
                        let count = 0;
                        const duration = 2000; // ms
                        const interval = 50; // ms
                        const increment = Math.ceil(target / (duration / interval));
                        
                        const counter = setInterval(() => {
                            count += increment;
                            if (count >= target) {
                                count = target;
                                clearInterval(counter);
                            }
                            
                            if (target > 1000) {
                                stat.textContent = count.toLocaleString() + '+';
                            } else {
                                stat.textContent = count + '+';
                            }
                        }, interval);
                    });
                    
                    animated = true;
                }
            }

            window.addEventListener('scroll', animateStats);
            
            // Check if stats are already visible on page load
            animateStats();
        });
    </script>
</body>
</html>