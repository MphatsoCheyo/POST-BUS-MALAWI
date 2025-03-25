<?php
$page_name = 'contact us';  // Set the current page name
include('../pages/header.php');
?>
    <div class="back-to-top" id="backToTop" onclick="scrollToTop()">
        <i class="fas fa-arrow-up"></i>
    </div>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Post Bus Malawi</title>
</head>
<body>
    <div class="containery">
        <!-- Header -->
        <header class="headery">
            <button class="back-btn" onclick="goBack()">←</button>
            <p data-translate="tagline">Safe & Reliable Transport</p>
        </header>

        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h2 data-translate="contactTitle">Contact Us</h2>
                <p data-translate="contactSubtitle">We are here to help with your travel needs across Malawi</p>
            </div>
        </section>

        <!-- Contact Options -->
        <section class="contact-options">
            <div class="contact-option" onclick="makeCall('0888123456')">
                <div class="option-icon">
                    📞
                </div>
                <div class="option-content">
                    <h3 data-translate="callUs">Call Us</h3>
                    <p>+265 888 123 456</p>
                </div>
            </div>

            <div class="contact-option" onclick="sendEmail('info@postbusmalawi.mw')">
                <div class="option-icon">
                    ✉️
                </div>
                <div class="option-content">
                    <h3 data-translate="emailUs">Email Us</h3>
                    <p>info@postbusmalawi.mw</p>
                </div>
            </div>

            <div class="contact-option" onclick="openWhatsApp('265888123456')">
                <div class="option-icon">
                    💬
                </div>
                <div class="option-content">
                    <h3 data-translate="whatsApp">WhatsApp</h3>
                    <p>+265 888 123 456</p>
                </div>
            </div>

            <div class="contact-option" onclick="showLocation('-13.9626,33.7741')">
                <div class="option-icon">
                    📍
                </div>
                <div class="option-content">
                    <h3 data-translate="mainOffice">Main Office</h3>
                    <p>Post Office Building, Area 3, Lilongwe</p>
                </div>
            </div>
        </section>

        <!-- Contact Form -->
        <section class="contact-form">
            <h3 data-translate="sendMessage">Send Us a Message</h3>
            <form id="contactForm" onsubmit="submitForm(event)">
                <div class="form-group">
                    <label for="name" data-translate="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email" data-translate="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone" data-translate="phone">Phone</label>
                    <input type="tel" id="phone" name="phone">
                </div>
                <div class="form-group">
                    <label for="inquiryType" data-translate="inquiryType">Type of Inquiry</label>
                    <select id="inquiryType" name="inquiryType">
                        <option value="booking" data-translate="booking">Booking Information</option>
                        <option value="schedule" data-translate="schedule">Schedule Inquiry</option>
                        <option value="feedback" data-translate="feedback">Feedback</option>
                        <option value="complaint" data-translate="complaint">Complaint</option>
                        <option value="other" data-translate="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="message" data-translate="message">Message</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="submit-btn" data-translate="send">Send Message</button>
            </form>
        </section>

        <!-- Stations Section -->
        <section class="stations">
            <h3 data-translate="majorStations">Major Post Bus Stations</h3>
            
            <div class="station">
                <h4><i>📍</i> <span data-translate="lilongwe">Lilongwe</span></h4>
                <p>Post Office Building, Area 3</p>
                <p>+265 888 123 456</p>
            </div>
            
            <div class="station">
                <h4><i>📍</i> <span data-translate="blantyre">Blantyre</span></h4>
                <p>Post Office Building, Victoria Avenue</p>
                <p>+265 888 987 654</p>
            </div>
            
            <div class="station">
                <h4><i>📍</i> <span data-translate="mzuzu">Mzuzu</span></h4>
                <p>Post Office Building, Main Street</p>
                <p>+265 888 456 789</p>
            </div>
            
            <div class="station">
                <h4><i>📍</i> <span data-translate="zomba">Zomba</span></h4>
                <p>Post Office Building, M3 Road</p>
                <p>+265 888 567 890</p>
            </div>
        </section>

        <!-- Map Section -->
        <h3 data-translate="findUs">Find Us</h3>
                    <section class="map-container">
                    <!-- Leaflet.js Map -->
                    <div id="map" class="map"></div>

                </section>

        <!-- Success Modal -->
        <div class="modal" id="successModal">
            <div class="modal-content">
                <h3 data-translate="thankYou">Thank You!</h3>
                <p data-translate="messageReceived">Your message has been received. We will get back to you shortly.</p>
                <button class="close-modal" onclick="closeModal()" data-translate="close">Close</button>
            </div>
        </div>
    </div>
    <?php
    include('../pages/footer.php');  // Include footer.php
    ?>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="../script/script.js"></script>

    <script>

                    var map = L.map('map').setView([-13.2543, 34.3015], 6); // Coordinates for Malawi, centered around the country

                    // Add a tile layer (using OpenStreetMap as a free provider)
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    // Post Bus Malawi Locations - Coordinates for each city
                    var locations = [
                        { name: "Lilongwe Office", coords: [-13.9893, 33.7748], description: "Post Bus Malawi office in Lilongwe." },
                        { name: "Blantyre Office", coords: [-15.7850, 35.0088], description: "Post Bus Malawi office in Blantyre." },
                        { name: "Mzuzu Office", coords: [-11.4667, 34.0111], description: "Post Bus Malawi office in Mzuzu." }
                    ];

                    // Loop through the locations array and add markers for each city
                    locations.forEach(function(location) {
                        L.marker(location.coords).addTo(map)
                            .bindPopup("<b>" + location.name + "</b><br>" + location.description)
                            .openPopup();
                    });
        // Language Translations
        const translations = {
            'en': {
                language: 'English',
                tagline: 'Safe & Reliable Transport',
                contactTitle: 'Contact Us',
                contactSubtitle: 'We are here to help with your travel needs across Malawi',
                callUs: 'Call Us',
                emailUs: 'Email Us',
                whatsApp: 'WhatsApp',
                mainOffice: 'Main Office',
                sendMessage: 'Send Us a Message',
                name: 'Name',
                email: 'Email',
                phone: 'Phone',
                inquiryType: 'Type of Inquiry',
                booking: 'Booking Information',
                schedule: 'Schedule Inquiry',
                feedback: 'Feedback',
                complaint: 'Complaint',
                other: 'Other',
                message: 'Message',
                send: 'Send Message',
                majorStations: 'Major Post Bus Stations',
                lilongwe: 'Lilongwe',
                blantyre: 'Blantyre',
                mzuzu: 'Mzuzu',
                zomba: 'Zomba',
                findUs: 'Find Us',
                copyright: '© 2025 Post Bus Malawi. All rights reserved.',
                operatedBy: 'Operated by Malawi Posts Corporation',
                thankYou: 'Thank You!',
                messageReceived: 'Your message has been received. We will get back to you shortly.',
                close: 'Close'
            },
            'ny': {
                language: 'Chichewa',
                tagline: 'Mayendedwe Otetezeka ndi Odalirika',
                contactTitle: 'Tilumikizeni',
                contactSubtitle: 'Tiri pano kukuthandizani pa zosowa zanu za mayendedwe mu Malawi',
                callUs: 'Tiimbireni',
                emailUs: 'Titumizireni Imelo',
                whatsApp: 'WhatsApp',
                mainOffice: 'Ofesi Yaikulu',
                sendMessage: 'Titumizireni Uthenga',
                name: 'Dzina',
                email: 'Imelo',
                phone: 'Foni',
                inquiryType: 'Mtundu wa Funso',
                booking: 'Zambiri za Kubukani',
                schedule: 'Zambiri za Nthawi za Maulendo',
                feedback: 'Maganizo',
                complaint: 'Dandaulo',
                other: 'Zina',
                message: 'Uthenga',
                send: 'Tumizani Uthenga',
                majorStations: 'Malowaima a Post Bus Aakulu',
                lilongwe: 'Lilongwe',
                blantyre: 'Blantyre',
                mzuzu: 'Mzuzu',
                zomba: 'Zomba',
                findUs: 'Tipezeni',
                copyright: '© 2025 Post Bus Malawi. Ufulu wonse ndi wathu.',
                operatedBy: 'Imagwira ntchito ndi Malawi Posts Corporation',
                thankYou: 'Zikomo!',
                messageReceived: 'Uthenga wanu walandiridwa. Tidzakuyankhaninso posachedwapa.',
                close: 'Tsekani'
            },
            'tum': {
                language: 'Chitumbuka',
                tagline: 'Wene Wakupepuka na Wakugomezgeka',
                contactTitle: 'Tikumanani',
                contactSubtitle: 'Tili apa kukovwirani pa vyakusoŵerwa vyinu vyakwenda mu Malawi',
                callUs: 'Tiyimbani',
                emailUs: 'Titumizgireni Kalata ya Intaneti',
                whatsApp: 'WhatsApp',
                mainOffice: 'Ofesi Yikulu',
                sendMessage: 'Titumizgireni Uthenga',
                name: 'Zina',
                email: 'Imeyili',
                phone: 'Foni',
                inquiryType: 'Mtundu wa Fumbo',
                booking: 'Vyakukhwaskana na Kubukani',
                schedule: 'Fumbo la Nyengo za Ulendo',
                feedback: 'Maganizo',
                complaint: 'Dandaulo',
                other: 'Vinyakhe',
                message: 'Uthenga',
                send: 'Tumizgani Uthenga',
                majorStations: 'Malo Vikuru vya Post Bus',
                lilongwe: 'Lilongwe',
                blantyre: 'Blantyre',
                mzuzu: 'Mzuzu',
                zomba: 'Zomba',
                findUs: 'Tikusakeni',
                copyright: '© 2025 Post Bus Malawi. Ufulu wose ngwithu.',
                operatedBy: 'Wakwendeskeka na Malawi Posts Corporation',
                thankYou: 'Yewo!',
                messageReceived: 'Uthenga winu wapokeka. Tizamuyowoya namwe mwasonosono.',
                close: 'Jalani'
            }
        };

        // Current language
        let currentLanguage = 'en';

        // Function to change language
        function changeLanguage(lang) {
            currentLanguage = lang;
            document.documentElement.lang = lang;
            
            // Update all translatable elements
            const elements = document.querySelectorAll('[data-translate]');
            elements.forEach(element => {
                const key = element.getAttribute('data-translate');
                if (translations[lang][key]) {
                    if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
                        element.placeholder = translations[lang][key];
                    } else if (element.tagName === 'OPTION') {
                        element.textContent = translations[lang][key];
                    } else {
                        element.textContent = translations[lang][key];
                    }
                }
            });
            
            // Close dropdown
            document.getElementById('languageDropdown').classList.remove('show');
            
            // Save preference
            localStorage.setItem('preferredLanguage', lang);
        }

        // Toggle language dropdown
        function toggleLanguage() {
            document.getElementById('languageDropdown').classList.toggle('show');
        }

        // Close dropdown when clicking outside
        window.onclick = function(event) {
            if (!event.target.matches('.language-btn')) {
                const dropdown = document.getElementById('languageDropdown');
                if (dropdown.classList.contains('show')) {
                    dropdown.classList.remove('show');
                }
            }
        };

        // Form submission
        function submitForm(event) {
            event.preventDefault();
            
            // In a real app, you would send the form data to a server
            console.log('Form submitted');
            
            // Show success modal
            document.getElementById('successModal').classList.add('active');
            
            // Reset form
            document.getElementById('contactForm').reset();
        }

        // Close modal
        function closeModal() {
            document.getElementById('successModal').classList.remove('active');
        }

        // Action functions
        function makeCall(number) {
            window.location.href = `tel:${number}`;
        }

        function sendEmail(email) {
            window.location.href = `mailto:${email}`;
        }

        function openWhatsApp(number) {
            window.open(`https://wa.me/${number}`, '_blank');
        }

        function showLocation(coords) {
            // In a real app, you would show the location on a map
            alert(`Showing location: ${coords}`);
        }

        function goBack() {
            window.history.back();
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Check for saved language preference
            const savedLanguage = localStorage.getItem('preferredLanguage');
            if (savedLanguage && translations[savedLanguage]) {
                changeLanguage(savedLanguage);
            }
        });
    </script>
   
    
    <script src="java.js"></script>
</body>
</html>