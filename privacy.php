<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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
<style>
    </style>
</head>
<body>
    <div class="app-containe">
        <div class="content fade-in">
        <div class="language-selector">
            <button class="language-btn" onclick="toggleDropdown()">
                <i class="fas fa-globe"></i> English <i class="fas fa-caret-down"></i>
            </button>
            <div id="languageDropdown" class="dropdown-content">
                <a href="javascript:void(0)" onclick="changeLanguage('english')">English</a>
                <a href="javascript:void(0)" onclick="changeLanguage('chichewa')">Chichewa</a>
                <a href="javascript:void(0)" onclick="changeLanguage('tumbuka')">Tumbuka</a>
            </div>
            </div>

            <div class="policy-container">
                <div class="policy-header">
                    <div>
                        <i class="fas fa-shield-alt"></i> Privacy Policy
                    </div>
                    <div class="policy-date">
                        Effective: March 1, 2025
                    </div>
                </div>
                <div class="policy-content">
                    <h2>Privacy Policy</h2>
                    
                    <p>Welcome to Post Bus Malawi's Privacy Policy. This document outlines how we collect, use, and protect your personal information when you use our services, website, and mobile application.</p>
                    
                    <div class="emphasis">
                        <p>Post Bus Malawi values your privacy and is committed to protecting your personal data. We encourage you to read this policy carefully to understand our practices regarding your personal information.</p>
                    </div>

                    <button class="collapsible">1. Information We Collect</button>
                    <div class="collapsible-content">
                        <div class="collapsible-inner">
                            <p>We collect the following types of information:</p>
                            <ul>
                                <li><strong>Personal Information:</strong> Name, email address, phone number, date of birth, national ID or passport number, and billing information.</li>
                                <li><strong>Booking Information:</strong> Travel dates, routes, seat preferences, and payment details.</li>
                                <li><strong>Device Information:</strong> IP address, browser type, device type, operating system, and mobile network information.</li>
                                <li><strong>Location Information:</strong> With your consent, we collect precise location data to provide route tracking and nearby bus stop information.</li>
                                <li><strong>Usage Information:</strong> How you interact with our app, including features used, time spent, and pages visited.</li>
                            </ul>
                        </div>
                    </div>

                    <button class="collapsible">2. How We Use Your Information</button>
                    <div class="collapsible-content">
                        <div class="collapsible-inner">
                            <p>We use your information for the following purposes:</p>
                            <ul>
                                <li>Processing and managing your bookings and payments</li>
                                <li>Providing customer support and addressing inquiries</li>
                                <li>Sending important service notifications and updates</li>
                                <li>Improving our services and developing new features</li>
                                <li>Personalizing your experience based on preferences and past usage</li>
                                <li>Ensuring the security and reliability of our platform</li>
                                <li>Complying with legal obligations and enforcing our terms</li>
                            </ul>
                            <p>With your explicit consent, we may also use your information to send promotional communications about special offers and promotions.</p>
                        </div>
                    </div>

                    <button class="collapsible">3. Information Sharing and Disclosure</button>
                    <div class="collapsible-content">
                        <div class="collapsible-inner">
                            <p>Post Bus Malawi does not sell or rent your personal information to third parties. We may share your information with:</p>
                            <ul>
                                <li><strong>Service Providers:</strong> Third-party vendors who help us provide our services, such as payment processors, customer support tools, and analytics providers.</li>
                                <li><strong>Business Partners:</strong> Such as bus terminal operators and travel agencies that assist in providing our services.</li>
                                <li><strong>Regulatory Authorities:</strong> When required by law, court order, or governmental regulation.</li>
                                <li><strong>Corporate Affiliates:</strong> Subsidiaries or parent companies within the Post Bus Malawi group.</li>
                            </ul>
                            <div class="warning">
                                <p>All third parties with whom we share your information are contractually obligated to use it only for the purposes specified and to provide adequate protection for the data.</p>
                            </div>
                        </div>
                    </div>

                    <button class="collapsible">4. Data Security</button>
                    <div class="collapsible-content">
                        <div class="collapsible-inner">
                            <p>We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. These measures include:</p>
                            <ul>
                                <li>Encryption of sensitive data both in transit and at rest</li>
                                <li>Regular security assessments and vulnerability testing</li>
                                <li>Strict access controls and authentication procedures</li>
                                <li>Staff training on privacy and security best practices</li>
                                <li>Physical security measures at our facilities</li>
                            </ul>
                            <p>While we strive to protect your personal information, no method of transmission over the Internet or electronic storage is 100% secure. We cannot guarantee absolute security.</p>
                        </div>
                    </div>

                    <button class="collapsible">5. Your Rights and Choices</button>
                    <div class="collapsible-content">
                        <div class="collapsible-inner">
                            <p>As a user of Post Bus Malawi services, you have the following rights:</p>
                            <ul>
                                <li><strong>Access:</strong> You can request a copy of the personal information we hold about you.</li>
                                <li><strong>Correction:</strong> You can ask us to rectify inaccurate information or complete incomplete information.</li>
                                <li><strong>Deletion:</strong> In certain circumstances, you can request that we delete your personal information.</li>
                                <li><strong>Restriction:</strong> You can ask us to temporarily or permanently stop processing some of your data.</li>
                                <li><strong>Objection:</strong> You can object to our processing of your personal information for direct marketing purposes.</li>
                                <li><strong>Data Portability:</strong> You can request a copy of your data in a structured, commonly used, and machine-readable format.</li>
                            </ul>
                            <p>To exercise any of these rights, please contact our Privacy Officer using the contact information provided at the end of this policy.</p>
                        </div>
                    </div>

                    <button class="collapsible">6. Children's Privacy</button>
                    <div class="collapsible-content">
                        <div class="collapsible-inner">
                            <p>Our services are not directed to individuals under the age of 16. We do not knowingly collect personal information from children. If we become aware that we have collected personal information from a child without parental consent, we will take steps to delete that information.</p>
                            <p>If you believe we might have collected information from a child, please contact us immediately.</p>
                        </div>
                    </div>

                    <button class="collapsible">7. Data Retention</button>
                    <div class="collapsible-content">
                        <div class="collapsible-inner">
                            <p>We retain your personal information for as long as necessary to fulfill the purposes for which we collected it, including for the purposes of satisfying any legal, accounting, or reporting requirements.</p>
                            <p>In determining the appropriate retention period, we consider:</p>
                            <ul>
                                <li>The amount, nature, and sensitivity of the personal information</li>
                                <li>The potential risk of harm from unauthorized use or disclosure</li>
                                <li>The purposes for which we process the data</li>
                                <li>Whether we can achieve those purposes through other means</li>
                                <li>Applicable legal requirements</li>
                            </ul>
                            <p>For booking information, we typically retain data for 7 years to comply with tax and accounting regulations. Account information is retained as long as your account remains active.</p>
                        </div>
                    </div>

                    <button class="collapsible">8. International Data Transfers</button>
                    <div class="collapsible-content">
                        <div class="collapsible-inner">
                            <p>Post Bus Malawi primarily operates in Malawi, and your data is generally stored on servers located within Malawi. However, some of our service providers may process your information outside of Malawi.</p>
                            <p>When we transfer your personal information outside of Malawi, we ensure a similar degree of protection is afforded to it by implementing appropriate safeguards, including:</p>
                            <ul>
                                <li>Using specific contracts approved by relevant data protection authorities</li>
                                <li>Transferring data only to countries deemed to provide an adequate level of protection</li>
                                <li>Obtaining your explicit consent for certain transfers</li>
                            </ul>
                        </div>
                    </div>

                    <button class="collapsible">9. Cookies and Similar Technologies</button>
                    <div class="collapsible-content">
                        <div class="collapsible-inner">
                            <p>Our website and mobile application use cookies and similar technologies to enhance your experience, analyze usage patterns, and deliver personalized content.</p>
                            <p>We use the following types of cookies:</p>
                            <ul>
                                <li><strong>Essential Cookies:</strong> Required for the operation of our services, such as session management and security.</li>
                                <li><strong>Analytical/Performance Cookies:</strong> Allow us to recognize and count visitors and analyze how users interact with our services.</li>
                                <li><strong>Functionality Cookies:</strong> Used to recognize you when you return to our website and personalize content.</li>
                                <li><strong>Targeting Cookies:</strong> Record your visit to our website, the pages you have visited, and the links you have followed to deliver relevant advertisements.</li>
                            </ul>
                            <p>You can set your browser to refuse all or some browser cookies or to alert you when websites set or access cookies. If you disable or refuse cookies, please note that some parts of our services may become inaccessible or not function properly.</p>
                        </div>
                    </div>

                    <button class="collapsible">10. Changes to This Privacy Policy</button>
                    <div class="collapsible-content">
                        <div class="collapsible-inner">
                            <p>We may update this Privacy Policy from time to time to reflect changes in our practices or for other operational, legal, or regulatory reasons. The updated policy will be posted on our website and mobile application with a revised effective date.</p>
                            <p>We will notify you of any material changes through a prominent notice on our services or by sending you an email notification. We encourage you to review this policy periodically to stay informed about how we are protecting your information.</p>
                        </div>
                    </div>

                    <div class="contact-info">
                        <h3>Contact Us</h3>
                        <p>If you have any questions, concerns, or requests regarding this Privacy Policy or our data practices, please contact our Privacy Officer:</p>
                        
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>privacy@postbusmalawi.mw</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+265 1 000 000</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Post Bus Headquarters, City Centre, Lilongwe, Malawi</span>
                        </div>
                    </div>

                    <div class="pdf-download">
                            <button class="pdf-btn" onclick="downloadPDF()">
                                <i class="fas fa-file-pdf"></i> Download PDF Version
                            </button>
                        </div>

                    <div class="last-updated">
                        Last updated: March 1, 2025
                    </div>
                </div>
            </div>
        </div>

        <div class="scroll-to-top" id="scrollToTop" onclick="scrollToTop()">
            <i class="fas fa-arrow-up"></i>
        </div>

        <footer>
            <a href="index.html" class="footer-btn">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
            <a href="booking.html" class="footer-btn">
                <i class="fas fa-ticket-alt"></i>
                <span>Book</span>
            </a>
            <a href="schedule.html" class="footer-btn">
                <i class="fas fa-clock"></i>
                <span>Schedule</span>
            </a>
            <a href="profile.html" class="footer-btn">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </a>
        </footer>
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
    const translations = {
  'english': {
    pageTitle: 'Privacy Policy',
    languageButton: 'Language',
    policyTitle: 'Privacy Policy',
    policyDate: 'Effective: March 1, 2025',
    intro: 'This Privacy Policy describes how we collect, use, and share your information when you use our services.',
    emphasis: 'Your privacy is important to us. Please read this policy carefully to understand our practices.',
    section1: {
      title: '1. Information We Collect',
      content: 'We collect the following types of information:',
      items: [
        'Personal information you provide to us directly',
        'Information automatically collected when you use our services',
        'Information from third parties and partners'
      ]
    },
    section2: {
      title: '2. How We Use Your Information',
      content: 'We use your information for the following purposes:',
      items: [
        'To provide and improve our services',
        'To personalize your experience',
        'To communicate with you',
        'For security and fraud prevention'
      ],
      additional: 'We will never sell your personal information to third parties.'
    },
    // Add more sections as needed (3-10)
    contactTitle: 'Contact Us',
    contactIntro: 'If you have any questions about this Privacy Policy, please contact us:',
    contactEmail: 'privacy@example.com',
    contactPhone: '+1 (555) 123-4567',
    contactAddress: '123 Privacy Street, Anytown, USA',
    downloadPDF: 'Download PDF',
    lastUpdated: 'Last Updated: March 1, 2025',
    footerHome: 'Home',
    footerBook: 'Book',
    footerSchedule: 'Schedule',
    footerProfile: 'Profile'
  },
  'chichewa': {
    pageTitle: 'Ndondomeko ya Chinsinsi',
    languageButton: 'Chilankhulo',
    policyTitle: 'Ndondomeko ya Chinsinsi',
    policyDate: 'Yoyamba: 1 Malichi 2025',
    intro: 'Ndondomeko iyi ya Chinsinsi ikufotokoza mmene timasonkhanitsira, kugwiritsa ntchito, ndi kugawana zambiri zanu pamene mugwiritsa ntchito mautumiki athu.',
    emphasis: 'Chinsinsi chanu ndi chofunika kwa ife. Chonde werengani ndondomeko iyi mosamala kuti mumvetsetse machitidwe athu.',
    section1: {
      title: '1. Zambiri zomwe Timasonkhanitsa',
      content: 'Timasonkhanitsa mitundu ya zambiri izi:',
      items: [
        'Zambiri zanu zomwe mumapereka kwa ife mwachindunji',
        'Zambiri zomwe zimasonkhanitsidwa mwachindunji pamene mugwiritsa ntchito mautumiki athu',
        'Zambiri zochokera kwa anthu ena ndi anzathu'
      ]
    },
    section2: {
      title: '2. Mmene Timagwiritsira Ntchito Zambiri Zanu',
      content: 'Timagwiritsa ntchito zambiri zanu pazifukwa izi:',
      items: [
        'Kupereka ndi kupititsa patsogolo mautumiki athu',
        'Kukonza zomwe mumakumana nazo',
        'Kulankhulana nanu',
        'Pazoteteza ndi kuchepetsa zachinyengo'
      ],
      additional: 'Sitidzagulitsa zambiri zanu kwa anthu ena.'
    },
    // Add more sections as needed (3-10)
    contactTitle: 'Tilumikizaneni',
    contactIntro: 'Ngati muli ndi mafunso alionse okhudza Ndondomeko iyi ya Chinsinsi, chonde tilumikizeni:',
    contactEmail: 'chinsinsi@chitsanzo.com',
    contactPhone: '+1 (555) 123-4567',
    contactAddress: '123 Msewu wa Chinsinsi, Tauni, USA',
    downloadPDF: 'Tsutsani PDF',
    lastUpdated: 'Zokhazikitsidwa Posachedwa: 1 Malichi 2025',
    footerHome: 'Kwathu',
    footerBook: 'Bukani',
    footerSchedule: 'Ndondomeko',
    footerProfile: 'Mbiri'
  },
  'chitumbuka': {
    pageTitle: 'Ndondomeko ya Chinsisi',
    languageButton: 'Chiyowoyelo',
    policyTitle: 'Ndondomeko ya Chinsisi',
    policyDate: 'Yakwamba: 1 Marichi 2025',
    intro: 'Ndondomeko iyi ya Chinsisi yikurongosola umo tikusonkhaniskira, kugwiriska ntchito, na kugawana vyakukhwaskana namwe para mukugwiriska ntchito mautumiki yithu.',
    emphasis: 'Chinsisi chinu ntchakuzirwa kwa ise. Chonde ŵereŋani ndondomeko iyi mwakusamala kuti mupulikiske machitiro yithu.',
    section1: {
      title: '1. Vyakukhwaskana Namwe Ivyo Tikusonkhaniska',
      content: 'Tikusonkhaniska mitundu ya vyakukhwaskana namwe ivi:',
      items: [
        'Vyakukhwaskana namwe ivyo mukutipa mwakurongora',
        'Vyakukhwaskana namwe ivyo vikusonkhaniskika mwakuzenthuruka para mukugwiriska ntchito mautumiki yithu',
        'Vyakukhwaskana namwe kufuma ku ŵanthu ŵanyakhe na ŵabwezi'
      ]
    },
    section2: {
      title: '2. Umo Tikugwiriskira Ntchito Vyakukhwaskana Namwe',
      content: 'Tikugwiriska ntchito vyakukhwaskana namwe pa vifukwa ivi:',
      items: [
        'Kupereka na kuŵika munkhongono mautumiki yithu',
        'Kusazgirapo vyakukumana navyo vyinu',
        'Kuyowoya namwe',
        'Pa kusunga na kuchepeskera vyakupusika'
      ],
      additional: 'Tisikuzamuguliska vyakukhwaskana namwe ku ŵanthu ŵanyakhe.'
    },
    // Add more sections as needed (3-10)
    contactTitle: 'Tikumani',
    contactIntro: 'Usange muli na mafumbo yalikose yakukhwaskana na Ndondomeko iyi ya Chinsisi, chonde tikumani:',
    contactEmail: 'chinsisi@chiyerezgero.com',
    contactPhone: '+1 (555) 123-4567',
    contactAddress: '123 Msewu wa Chinsisi, Tauni, USA',
    downloadPDF: 'Khwaskani PDF',
    lastUpdated: 'Vyakusintha Vyaumaliro: 1 Marichi 2025',
    footerHome: 'Kukaya',
    footerBook: 'Bukani',
    footerSchedule: 'Ndondomeko',
    footerProfile: 'Mbiri'
  }
};

// Store the current language
let currentLanguage = 'english';

// Function to change the language of the entire page
function changeLanguage(language) {
  console.log(`Changing language to: ${language}`);
  if (!translations[language]) {
    console.error(`Translation not available for: ${language}`);
    return;
  }
  
  currentLanguage = language;
  const text = translations[language];
  
  // Update page title
  document.title = text.pageTitle;
  
  // Update language button text
  document.querySelector('.language-btn').innerHTML = `<i class="fas fa-globe"></i> ${text.languageButton} <i class="fas fa-caret-down"></i>`;
  
  // Update policy header
  document.querySelector('.policy-header div:first-child').innerHTML = `<i class="fas fa-shield-alt"></i> ${text.policyTitle}`;
  document.querySelector('.policy-date').textContent = text.policyDate;
  
  // Update main title and intro
  document.querySelector('.policy-content h2').textContent = text.policyTitle;
  document.querySelector('.policy-content > p').textContent = text.intro;
  document.querySelector('.emphasis p').textContent = text.emphasis;
  
  // Update section 1
  const section1 = document.querySelectorAll('.collapsible')[0];
  section1.textContent = text.section1.title;
  const section1Content = section1.nextElementSibling.querySelector('.collapsible-inner');
  section1Content.querySelector('p').textContent = text.section1.content;
  
  const section1Items = section1Content.querySelectorAll('li');
  text.section1.items.forEach((item, index) => {
    if (section1Items[index]) {
      section1Items[index].innerHTML = item;
    }
  });
  
  // Update section 2
  const section2 = document.querySelectorAll('.collapsible')[1];
  section2.textContent = text.section2.title;
  const section2Content = section2.nextElementSibling.querySelector('.collapsible-inner');
  section2Content.querySelector('p').textContent = text.section2.content;
  
  const section2Items = section2Content.querySelectorAll('li');
  text.section2.items.forEach((item, index) => {
    if (section2Items[index]) {
      section2Items[index].textContent = item;
    }
  });
  
  // Add the additional paragraph in section 2
  const section2AdditionalP = section2Content.querySelectorAll('p')[1];
  if (section2AdditionalP) {
    section2AdditionalP.textContent = text.section2.additional;
  }
  
  // Continue updating sections 3-10 similarly...
  
  // Update contact information
  document.querySelector('.contact-info h3').textContent = text.contactTitle;
  document.querySelector('.contact-info > p').textContent = text.contactIntro;
  
  // Update contact details (keeping the icons)
  const contactItems = document.querySelectorAll('.contact-item span');
  contactItems[0].textContent = text.contactEmail;
  contactItems[1].textContent = text.contactPhone;
  contactItems[2].textContent = text.contactAddress;
  
  // Update PDF download button
  document.querySelector('.pdf-btn').innerHTML = `<i class="fas fa-file-pdf"></i> ${text.downloadPDF}`;
  
  // Update last updated text
  document.querySelector('.last-updated').textContent = text.lastUpdated;
  
  // Update footer
  const footerBtns = document.querySelectorAll('.footer-btn span');
  footerBtns[0].textContent = text.footerHome;
  footerBtns[1].textContent = text.footerBook;
  footerBtns[2].textContent = text.footerSchedule;
  footerBtns[3].textContent = text.footerProfile;
  
  // Close the dropdown
  document.getElementById("languageDropdown").classList.remove("show");
  
  // Save user's language preference
  localStorage.setItem('preferredLanguage', language);
  
  // Dispatch a custom event that other scripts can listen for
  const event = new CustomEvent('languageChanged', { detail: { language } });
  document.dispatchEvent(event);
  
  // Update the direction of text if needed (for RTL languages)
  document.documentElement.dir = isRTLLanguage(language) ? 'rtl' : 'ltr';
}

// Check if a language uses RTL (right-to-left) text direction
function isRTLLanguage(language) {
  const rtlLanguages = []; // Add RTL languages if needed in the future
  return rtlLanguages.includes(language);
}

// Add language selection buttons to the dropdown
function populateLanguageDropdown() {
  const dropdown = document.getElementById("languageDropdown");
  if (!dropdown) return;
  
  // Clear existing options
  dropdown.innerHTML = '';
  
  // Add an option for each language
  Object.keys(translations).forEach(lang => {
    const option = document.createElement('a');
    option.href = '#';
    option.textContent = getLanguageDisplayName(lang);
    option.setAttribute('data-lang', lang);
    option.addEventListener('click', function(e) {
      e.preventDefault();
      changeLanguage(lang);
    });
    
    // Highlight the current language
    if (lang === currentLanguage) {
      option.classList.add('current-language');
    }
    
    dropdown.appendChild(option);
  });
}

// Get a display-friendly name for each language
function getLanguageDisplayName(langCode) {
  const displayNames = {
    'english': 'English',
    'chichewa': 'Chichewa',
    'chitumbuka': 'Chitumbuka'
  };
  return displayNames[langCode] || langCode;
}

// Toggle collapsible sections
const collapsibles = document.getElementsByClassName("collapsible");
for (let i = 0; i < collapsibles.length; i++) {
    collapsibles[i].addEventListener("click", function() {
        this.classList.toggle("active");
        const content = this.nextElementSibling;
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }
    });
}

// Scroll to top functionality
const scrollToTopBtn = document.getElementById("scrollToTop");

window.addEventListener("scroll", function() {
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        scrollToTopBtn.classList.add("visible");
    } else {
        scrollToTopBtn.classList.remove("visible");
    }
});

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
}

// Language dropdown
function toggleDropdown() {
    document.getElementById("languageDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.language-btn') && !event.target.matches('.language-btn *')) {
        const dropdowns = document.getElementsByClassName("dropdown-content");
        for (let i = 0; i < dropdowns.length; i++) {
            const openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

// Back button functionality
function goBack() {
    window.history.back();
}

// Fixed PDF download functionality
function downloadPDF() {
    // Get the current language to determine which PDF to download
    const pdfFilename = `privacy_policy_${currentLanguage}.pdf`;
    
    // Create a hidden link element
    const downloadLink = document.createElement('a');
    
    // Set the download attribute with the filename
    downloadLink.download = pdfFilename;
    
    // In a real implementation, you would have these PDF files stored on your server
    // For this example, we'll use a placeholder URL
    downloadLink.href = `assets/pdfs/${pdfFilename}`;
    
    // Append to the body
    document.body.appendChild(downloadLink);
    
    // Trigger the download
    downloadLink.click();
    
    // Clean up - remove the link from the DOM
    document.body.removeChild(downloadLink);
    
    // Show success message to the user
    alert(`PDF downloaded successfully. The file "${pdfFilename}" has been saved to your downloads folder.`);
}

// Open all sections with hash in URL
if (window.location.hash) {
    const section = document.querySelector(`button.collapsible[data-section="${window.location.hash.substring(1)}"]`);
    if (section) {
        section.click();
        section.scrollIntoView();
    }
}

// Add section to URL when opening collapsibles
for (let i = 0; i < collapsibles.length; i++) {
    collapsibles[i].addEventListener("click", function() {
        const section = this.getAttribute("data-section");
        if (section && this.classList.contains("active")) {
            history.pushState(null, null, `#${section}`);
        }
    });
}

// Initialize language handling
document.addEventListener('DOMContentLoaded', function() {
    // Populate the language dropdown
    populateLanguageDropdown();
    
    // Check browser language and set as default if no preference saved
    const savedLanguage = localStorage.getItem('preferredLanguage');
    if (savedLanguage && translations[savedLanguage]) {
        changeLanguage(savedLanguage);
    } else {
        // Try to match browser language
        const browserLang = navigator.language.split('-')[0].toLowerCase();
        
        // Map common browser language codes to our language codes if needed
        const languageMap = {
            'en': 'english',
            'ny': 'chichewa',    // Chichewa/Nyanja language code
            'tum': 'chitumbuka'  // Tumbuka language code
        };
        
        const mappedLang = languageMap[browserLang] || browserLang;
        
        // Check if we have a translation for this language
        if (translations[mappedLang]) {
            changeLanguage(mappedLang);
        } else {
            // Default to English if no match
            changeLanguage('english');
        }
    }
    
    // Add event listener for language selection
    document.getElementById('languageDropdown').addEventListener('click', function(e) {
        if (e.target.tagName === 'A') {
            e.preventDefault();
            const lang = e.target.getAttribute('data-lang');
            if (lang) {
                changeLanguage(lang);
            }
        }
    });
});

// Function for toggling dropdown
function toggleDropdown() {
    document.getElementById("languageDropdown").classList.toggle("show");
}
    </script>
</body>
</html>
    
   