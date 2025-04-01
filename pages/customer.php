<?php
$page_name = 'about us';  
include('../pages/header.php');
?>
<body>
    <div class="containeree">
        <div class="tabs">
            <div class="tab active" data-tab="chat">Chat Support</div>
            <div class="tab" data-tab="help">Help Center</div>
            <div class="tab" data-tab="ticket">Support Ticket</div>
        </div>

        <!-- Chat Support Tab -->
        <div class="tab-content active" id="chat-tab">
            <div class="quick-actions">
                <div class="quick-action" id="faqsBtn">
                    <i class="fas fa-question-circle"></i>
                    <span class="quick-action-label">FAQs</span>
                </div>
                <div class="quick-action">
                    <i class="fas fa-phone-alt"></i>
                    <span class="quick-action-label">Call Us</span>
                </div>
                <div class="quick-action">
                    <i class="fas fa-envelope"></i>
                    <span class="quick-action-label">Email</span>
                </div>
            </div>

            <div class="search-container">
                <div class="search-bar">
                    <input type="text" class="search-input" placeholder="Search for help...">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <div id="faqSection" class="faq-section">
                <div class="faq-category">
                    <i class="fas fa-ticket-alt"></i> Booking & Tickets
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        How do I book a ticket?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        To book a ticket, navigate to the "Book a Ticket" section in the app. Select your departure city, destination, date, and preferred time. Choose your seat, fill in passenger details, and proceed to payment. Once payment is confirmed, you'll receive a digital ticket with a QR code.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        Can I cancel my ticket?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Yes, you can cancel your ticket up to 24 hours before the scheduled departure. Go to "My Tickets" in your profile, select the ticket you wish to cancel, and tap on "Cancel Ticket". Refund policies vary based on how far in advance you cancel. Cancellations made less than 24 hours before departure are not eligible for refunds.
                    </div>
                </div>

                <div class="faq-category">
                    <i class="fas fa-bus"></i> Bus Services
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        What amenities are available on the bus?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Our buses are equipped with air conditioning, comfortable seating, USB charging ports, and free Wi-Fi. Premium buses also include onboard entertainment, refreshments, and extra legroom. All buses have onboard restrooms for long journeys.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        How can I track my bus?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        You can track your bus in real-time through the "Track Bus" feature in the app. This shows the current location of your bus, estimated time of arrival, and any delays. The tracking becomes available 1 hour before the scheduled departure time.
                    </div>
                </div>

                <div class="faq-category">
                    <i class="fas fa-credit-card"></i> Payment & Refunds
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        What payment methods are accepted?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        We accept various payment methods including credit/debit cards, mobile money (Airtel Money, TNM Mpamba), bank transfers, and PayPal. You can also pay in cash at any Post Bus Malawi ticket office.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        How long do refunds take to process?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Refunds typically take 3-5 business days to process. The time it takes for the funds to appear in your account depends on your payment method and bank. Mobile money refunds are usually processed within 24 hours.
                    </div>
                </div>
            </div>

            <div id="chatSection" class="chat-section" style="display: none;">
                <div class="chat-messages" id="chatMessages">
                    <div class="message message-agent">
                        <div class="message-bubble">
                            Hello! Welcome to Post Bus Malawi support. How can I help you today?
                        </div>
                        <div class="message-time">10:30 AM</div>
                    </div>
                </div>
                <div class="message-typing" id="typingIndicator" style="display: none;">
                    <span>Support agent is typing</span>
                    <div class="typing-indicator">
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                    </div>
                </div>
                <div class="chat-input">
                    <input type="text" id="chatInput" placeholder="Type your message...">
                    <button class="send-btn" id="sendMessage">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>

            <div class="contact-options">
                <div class="contact-title">Other Contact Options</div>
                <div class="contact-option">
                    <div class="contact-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="contact-details">
                        <div class="contact-label">Phone Support</div>
                        <div class="contact-info">Available 7AM - 9PM, Every day</div>
                    </div>
                    <div class="contact-action">Call</div>
                </div>
                <div class="contact-option">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contact-details">
                        <div class="contact-label">Email Support</div>
                        <div class="contact-info">Response within 24 hours</div>
                    </div>
                    <div class="contact-action">Email</div>
                </div>
                <div class="contact-option">
                    <div class="contact-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div class="contact-details">
                        <div class="contact-label">WhatsApp Support</div>
                        <div class="contact-info">Chat with our support team</div>
                    </div>
                    <div class="contact-action">Chat</div>
                </div>
            </div>

            <div class="rating-section">
                <div class="rating-title">Rate Your Experience</div>
                <div class="rating-stars" id="ratingStars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="rating-text">How was your experience with our customer support?</div>
                <button class="rating-btn">Submit Rating</button>
            </div>
        </div>

        <!-- Help Center Tab -->
        <div class="tab-content" id="help-tab">
            <div class="search-container">
                <div class="search-bar">
                    <input type="text" class="search-input" placeholder="Search tutorials and guides...">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="help-category">
                <div class="help-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <div class="help-content">
                    <div class="help-title">User Guides</div>
                    <div class="help-desc">Step-by-step guides on using the app</div>
                </div>
                <div class="help-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>

            <div class="help-category">
                <div class="help-icon">
                    <i class="fas fa-video"></i>
                </div>
                <div class="help-content">
                    <div class="help-title">Video Tutorials</div>
                    <div class="help-desc">Watch how to use app features</div>
                </div>
                <div class="help-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>

            <div class="help-category">
                <div class="help-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="help-content">
                    <div class="help-title">Booking Instructions</div>
                    <div class="help-desc">Learn how to book tickets easily</div>
                </div>
                <div class="help-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>

            <div class="help-category">
                <div class="help-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <div class="help-content">
                    <div class="help-title">Troubleshooting</div>
                    <div class="help-desc">Solutions to common problems</div>
                </div>
                <div class="help-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>

            <div class="tutorial-item">
                <div class="tutorial-thumbnail">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <div class="tutorial-content">
                    <div class="tutorial-title">How to Book a Ticket</div>
                    <div class="tutorial-duration">3:45 min</div>
                </div>
            </div>

            <div class="tutorial-item">
                <div class="tutorial-thumbnail">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <div class="tutorial-content">
                    <div class="tutorial-title">How to Track Your Bus</div>
                    <div class="tutorial-duration">2:30 min</div>
                </div>
            </div>

            <div class="tutorial-item">
                <div class="tutorial-thumbnail">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <div class="tutorial-content">
                    <div class="tutorial-title">Changing or Cancelling Tickets</div>
                    <div class="tutorial-duration">4:15 min</div>
                </div>
            </div>
        </div>

        <!-- Support Ticket Tab -->
        <div class="tab-content" id="ticket-tab">
            <div class="ticket-form">
                <div class="form-title">Submit a Support Ticket</div>
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-input" placeholder="Your full name">
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" placeholder="Your email address">
                </div>
                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="tel" class="form-input" placeholder="Your phone number">
                </div>
                <div class="form-group">
                    <label class="form-label">Issue Type</label>
                    <select class="form-select">
                        <option value="">Select issue type</option>
                        <option value="booking">Booking Problem</option>
                        <option value="payment">Payment Issue</option>
                        <option value="refund">Refund Request</option>
                        <option value="account">Account Problem</option>
                        <option value="other">Other Issue</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Subject</label>
                    <input type="text" class="form-input" placeholder="Brief description of the issue">
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea class="form-textarea" placeholder="Please provide details about your issue"></textarea>
                </div>
                <button class="submit-btn" id="submitTicket">Submit Ticket</button>
            </div>

            <div class="success-message" id="successMessage">
                <i class="fas fa-check-circle" style="font-size: 2rem; margin-bottom: 10px;"></i>
                <h3>Ticket Submitted Successfully!</h3>
                <p>We'll get back to you within 24 hours.</p>
            </div>

            <div class="ticket-history">
                <div class="contact-title">Your Recent Tickets</div>
                <div class="ticket-item">
                    <div class="ticket-header">
                        <div class="ticket-id">#8452</div>
                        <div class="ticket-status status-resolved">Resolved</div>
                    </div>
                    <div class="ticket-subject">Payment not processed but amount deducted</div>
                    <div class="ticket-date">March 12, 2025</div>
                </div>
                <div class="ticket-item">
                    <div class="ticket-header">
                        <div class="ticket-id">#8126</div>
                        <div class="ticket-status status-pending">Pending</div>
                    </div>
                    <div class="ticket-subject">Unable to change seat selection</div>
                    <div class="ticket-date">March 10, 2025</div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('../pages/footer.php');  // Include footer.php
    ?>

    <script>
        // Tab switching functionality
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const tabId = tab.getAttribute('data-tab');
                
                // Remove active class from all tabs and tab contents
                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                
                // Add active class to selected tab and content
                tab.classList.add('active');
                document.getElementById(`${tabId}-tab`).classList.add('active');
            });
        });

        // FAQ accordion functionality
        const faqQuestions = document.querySelectorAll('.faq-question');

        faqQuestions.forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                
                // Toggle active class on question
                question.classList.toggle('active');
                
                // Toggle show class on answer
                answer.classList.toggle('show');
                
                // Close other open FAQs
                faqQuestions.forEach(q => {
                    if (q !== question && q.classList.contains('active')) {
                        q.classList.remove('active');
                        q.nextElementSibling.classList.remove('show');
                    }
                });
            });
        });

        // Rating functionality
        const stars = document.querySelectorAll('#ratingStars i');

        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                // Reset all stars
                stars.forEach(s => s.classList.remove('active'));
                
                // Activate clicked star and all previous stars
                for (let i = 0; i <= index; i++) {
                    stars[i].classList.add('active');
                }
            });
        });

        // Navigation drawer functionality
        const menuToggle = document.getElementById('menuToggle');
        const navDrawer = document.getElementById('navDrawer');
        const navBackdrop = document.getElementById('navBackdrop');

        menuToggle.addEventListener('click', () => {
            navDrawer.classList.add('open');
            navBackdrop.classList.add('visible');
        });

        navBackdrop.addEventListener('click', () => {
            navDrawer.classList.remove('open');
            navBackdrop.classList.remove('visible');
        });

        // Chat functionality
        const chatInput = document.getElementById('chatInput');
        const sendMessage = document.getElementById('sendMessage');
        const chatMessages = document.getElementById('chatMessages');
        const typingIndicator = document.getElementById('typingIndicator');
        const faqsBtn = document.getElementById('faqsBtn');
        const faqSection = document.getElementById('faqSection');
        const chatSection = document.getElementById('chatSection');

        // Switch between FAQs and chat
        faqsBtn.addEventListener('click', () => {
            faqSection.style.display = 'none';
            chatSection.style.display = 'flex';
        });

        // Send message function
        sendMessage.addEventListener('click', () => {
            const message = chatInput.value.trim();
            
            if (message) {
                // Add user message
                const currentTime = new Date();
                const timeString = currentTime.getHours() + ':' + (currentTime.getMinutes() < 10 ? '0' : '') + currentTime.getMinutes();
                
                const userMessageHTML = `
                    <div class="message message-user">
                        <div class="message-bubble">
                            ${message}
                        </div>
                        <div class="message-time">${timeString}</div>
                    </div>
                `;
                
                chatMessages.innerHTML += userMessageHTML;
                chatInput.value = '';
                
                // Scroll to bottom
                chatMessages.scrollTop = chatMessages.scrollHeight;
                
                // Show typing indicator
                typingIndicator.style.display = 'flex';
                
                // Simulate agent response after delay
                setTimeout(() => {
                    typingIndicator.style.display = 'none';
                    
                    const agentResponse = getAgentResponse(message);
                    const agentTimeString = currentTime.getHours() + ':' + (currentTime.getMinutes() < 10 ? '0' : '') + (currentTime.getMinutes() + 1);
                    
                    const agentMessageHTML = `
                        <div class="message message-agent">
                            <div class="message-bubble">
                                ${agentResponse}
                            </div>
                            <div class="message-time">${agentTimeString}</div>
                        </div>
                    `;
                    
                    chatMessages.innerHTML += agentMessageHTML;
                    
                    // Scroll to bottom
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }, 1500);
            }
        });

        // Handle enter key press in chat input
        chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage.click();
            }
        });

        // Simple agent response function
        function getAgentResponse(message) {
            message = message.toLowerCase();
            
            if (message.includes('book') || message.includes('ticket')) {
                return "To book a ticket, you can use our app or website. Select your origin, destination, date, and preferred time. You can then choose your seat and make payment using various methods including mobile money, credit cards, or bank transfer.";
            } else if (message.includes('cancel')) {
                return "You can cancel your ticket up to 24 hours before departure. Go to 'My Tickets' section, select the ticket you want to cancel, and follow the cancellation process. Refund will be processed based on our refund policy.";
            } else if (message.includes('refund')) {
                return "Refunds typically take 3-5 business days to process. The time for funds to appear in your account depends on your payment method and bank. For more details on your specific refund, please provide your booking reference.";
            } else if (message.includes('bus') || message.includes('track')) {
                return "You can track your bus in real-time through our app. Go to 'My Trips' and tap on 'Track Bus' for your active booking. This feature becomes available 1 hour before scheduled departure.";
            } else if (message.includes('hi') || message.includes('hello') || message.includes('hey')) {
                return "Hello there! How can I assist you with Post Bus Malawi services today?";
            } else {
                return "Thank you for your message. I'd be happy to help you with that. Could you please provide more details so I can assist you better?";
            }
        }

        // Submit ticket form
        const submitTicketBtn = document.getElementById('submitTicket');
        const successMessage = document.getElementById('successMessage');
        const ticketForm = document.querySelector('.ticket-form');

        submitTicketBtn.addEventListener('click', () => {
            // Simple form validation (can be enhanced)
            const inputs = document.querySelectorAll('.form-input, .form-select, .form-textarea');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.style.borderColor = 'red';
                    isValid = false;
                } else {
                    input.style.borderColor = '';
                }
            });
            
            if (isValid) {
                // Hide form and show success message
                ticketForm.style.display = 'none';
                successMessage.style.display = 'block';
                
                // Reset form
                inputs.forEach(input => {
                    input.value = '';
                });
                
                // After 5 seconds, hide success message and show form again
                setTimeout(() => {
                    successMessage.style.display = 'none';
                    ticketForm.style.display = 'block';
                }, 5000);
            }
        });
    </script>
</body>
</html>