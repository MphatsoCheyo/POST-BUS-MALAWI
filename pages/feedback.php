<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Bus Malawi - Feedback System</title>
    <style>
        :root {
            --primary-color: #007A33; /* Malawi flag green */
            --secondary-color: #CE1126; /* Malawi flag red */
            --accent-color: #000000; /* Malawi flag black */
            --background-color: #f5f5f5;
            --text-color: #333;
            --success-color: #4CAF50;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        header {
            background-color: var(--primary-color);
            color: white;
            padding: 15px 0;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .logo {
            width: 50px;
            height: 50px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 20px;
            color: var(--primary-color);
        }
        
        .tabs {
            display: flex;
            background-color: white;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 0 0 8px 8px;
        }
        
        .tab {
            flex: 1;
            text-align: center;
            padding: 15px 0;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .tab.active {
            color: var(--primary-color);
            border-bottom: 3px solid var(--primary-color);
        }
        
        .content {
            display: none;
            animation: fadeIn 0.5s;
        }
        
        .content.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .card-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--primary-color);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }
        
        .rating input {
            display: none;
        }
        
        .rating label {
            cursor: pointer;
            width: 40px;
            height: 40px;
            margin: 0 5px;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3e%3cpath d='M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z' fill='%23d3d3d3'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 30px;
            transition: 0.3s;
        }
        
        .rating input:checked ~ label,
        .rating label:hover,
        .rating input:checked + label:hover,
        .rating input:checked ~ label:hover {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3e%3cpath d='M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z' fill='%23007A33'/%3e%3c/svg%3e");
        }
        
        .btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            background-color: #005a25;
        }
        
        .feedback-item {
            border-left: 4px solid var(--primary-color);
            padding: 12px;
            margin-bottom: 15px;
            background-color: rgba(0, 122, 51, 0.05);
            border-radius: 0 4px 4px 0;
        }
        
        .feedback-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        
        .feedback-route {
            font-weight: 600;
        }
        
        .feedback-date {
            color: #777;
            font-size: 14px;
        }
        
        .feedback-rating {
            display: flex;
            margin-bottom: 8px;
        }
        
        .star {
            color: var(--primary-color);
            margin-right: 2px;
        }
        
        .implementation-item {
            display: flex;
            margin-bottom: 20px;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .implementation-icon {
            width: 80px;
            background-color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }
        
        .implementation-content {
            flex: 1;
            padding: 15px;
        }
        
        .implementation-title {
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--primary-color);
        }
        
        .implementation-date {
            color: #777;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .success-msg {
            display: none;
            background-color: var(--success-color);
            color: white;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .floating-notification {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: var(--primary-color);
            color: white;
            padding: 15px 25px;
            border-radius: 30px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
            display: none;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        @media (max-width: 480px) {
            .rating label {
                width: 35px;
                height: 35px;
            }
            
            .implementation-icon {
                width: 60px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo-container">
                <div class="logo">PB</div>
                <h1>Post Bus Malawi</h1>
            </div>
        </div>
    </header>
    
    <div class="container">
        <div class="tabs">
            <div class="tab active" data-tab="feedback">Submit Feedback</div>
            <div class="tab" data-tab="submissions">Past Submissions</div>
            <div class="tab" data-tab="implemented">We've Done</div>
        </div>
        
        <div id="success-msg" class="success-msg">
            Thank you for your feedback! We value your input.
        </div>
        
        <div id="feedback-content" class="content active">
            <div class="card">
                <div class="card-title">Post-Journey Feedback</div>
                <form id="feedback-form">
                    <div class="form-group">
                        <label for="route">Route</label>
                        <select id="route" required>
                            <option value="">Select Route</option>
                            <option value="Lilongwe - Blantyre">Lilongwe - Blantyre</option>
                            <option value="Blantyre - Lilongwe">Blantyre - Lilongwe</option>
                            <option value="Lilongwe - Mzuzu">Lilongwe - Mzuzu</option>
                            <option value="Mzuzu - Lilongwe">Mzuzu - Lilongwe</option>
                            <option value="Blantyre - Zomba">Blantyre - Zomba</option>
                            <option value="Zomba - Blantyre">Zomba - Blantyre</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="journey-date">Journey Date</label>
                        <input type="date" id="journey-date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="ticket-number">Ticket Number (Optional)</label>
                        <input type="text" id="ticket-number" placeholder="e.g. PB12345678">
                    </div>
                    
                    <div class="form-group">
                        <label>Rate Your Overall Experience</label>
                        <div class="rating">
                            <input type="radio" id="star5" name="rating" value="5">
                            <label for="star5"></label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4"></label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3"></label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2"></label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1"></label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="feedback-type">Feedback Type</label>
                        <select id="feedback-type" required>
                            <option value="">Select Type</option>
                            <option value="Compliment">Compliment</option>
                            <option value="Suggestion">Suggestion</option>
                            <option value="Complaint">Complaint</option>
                            <option value="Question">Question</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="feedback-text">Your Feedback</label>
                        <textarea id="feedback-text" placeholder="Please share your experience with us..." required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact">Contact Information (Optional)</label>
                        <input type="text" id="contact" placeholder="Phone or Email">
                    </div>
                    
                    <button type="submit" class="btn">Submit Feedback</button>
                </form>
            </div>
        </div>
        
        <div id="submissions-content" class="content">
            <div class="card">
                <div class="card-title">Your Past Feedback</div>
                <div id="past-feedback-list">
                    <!-- Past feedback will be loaded here -->
                </div>
            </div>
        </div>
        
        <div id="implemented-content" class="content">
            <div class="card">
                <div class="card-title">You've Said, We've Done</div>
                <p>We listen to our customers and implement your valuable suggestions:</p>
                <div id="implementations-list">
                    <!-- Implementations will be loaded here -->
                </div>
            </div>
        </div>
    </div>
    
    <div id="notification" class="floating-notification"></div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab switching functionality
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs and content
                    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                    document.querySelectorAll('.content').forEach(c => c.classList.remove('active'));
                    
                    // Add active class to clicked tab
                    this.classList.add('active');
                    
                    // Show corresponding content
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(`${tabId}-content`).classList.add('active');
                    
                    // Load data if needed
                    if (tabId === 'submissions') {
                        loadPastFeedback();
                    } else if (tabId === 'implemented') {
                        loadImplementations();
                    }
                });
            });
            
            // Form submission
            const feedbackForm = document.getElementById('feedback-form');
            feedbackForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Gather form data
                const feedbackData = {
                    route: document.getElementById('route').value,
                    journeyDate: document.getElementById('journey-date').value,
                    ticketNumber: document.getElementById('ticket-number').value,
                    rating: document.querySelector('input[name="rating"]:checked')?.value || "0",
                    feedbackType: document.getElementById('feedback-type').value,
                    feedbackText: document.getElementById('feedback-text').value,
                    contact: document.getElementById('contact').value,
                    submissionDate: new Date().toISOString()
                };
                
                // Save feedback (in real app, this would be an API call)
                saveFeedback(feedbackData);
                
                // Show success message
                document.getElementById('success-msg').style.display = 'block';
                
                // Reset form
                feedbackForm.reset();
                
                // Hide success message after 3 seconds
                setTimeout(() => {
                    document.getElementById('success-msg').style.display = 'none';
                }, 3000);
            });
            
            // Load initial sample data
            loadPastFeedback();
            loadImplementations();
        });
        
        // Function to save feedback to localStorage (simulating backend storage)
        function saveFeedback(feedbackData) {
            // Get existing feedback or initialize empty array
            let feedbackList = JSON.parse(localStorage.getItem('postBusFeedback')) || [];
            
            // Add new feedback
            feedbackList.push(feedbackData);
            
            // Save back to localStorage
            localStorage.setItem('postBusFeedback', JSON.stringify(feedbackList));
            
            // Show notification
            showNotification('Feedback submitted successfully!');
        }
        
        // Function to load past feedback
        function loadPastFeedback() {
            const pastFeedbackList = document.getElementById('past-feedback-list');
            
            // Get feedback from localStorage
            let feedbackList = JSON.parse(localStorage.getItem('postBusFeedback')) || [];
            
            // If empty, add sample data
            if (feedbackList.length === 0) {
                feedbackList = [
                    {
                        route: "Lilongwe - Blantyre",
                        journeyDate: "2025-03-10",
                        rating: "4",
                        feedbackType: "Compliment",
                        feedbackText: "The bus was very clean and comfortable. The driver was professional and kept to the schedule.",
                        submissionDate: "2025-03-11T08:30:00Z"
                    },
                    {
                        route: "Mzuzu - Lilongwe",
                        journeyDate: "2025-03-05",
                        rating: "3",
                        feedbackType: "Suggestion",
                        feedbackText: "It would be great if you could provide WiFi on long journeys. Also, more legroom would be appreciated.",
                        submissionDate: "2025-03-06T14:15:00Z"
                    }
                ];
                localStorage.setItem('postBusFeedback', JSON.stringify(feedbackList));
            }
            
            // Clear existing content
            pastFeedbackList.innerHTML = '';
            
            // Check if there's any feedback
            if (feedbackList.length === 0) {
                pastFeedbackList.innerHTML = '<p>You haven\'t submitted any feedback yet.</p>';
                return;
            }
            
            // Sort feedback by submission date (newest first)
            feedbackList.sort((a, b) => new Date(b.submissionDate) - new Date(a.submissionDate));
            
            // Render feedback items
            feedbackList.forEach(feedback => {
                const feedbackItem = document.createElement('div');
                feedbackItem.className = 'feedback-item';
                
                // Format date
                const submissionDate = new Date(feedback.submissionDate);
                const formattedDate = submissionDate.toLocaleDateString('en-GB');
                
                // Create stars for rating
                let stars = '';
                for (let i = 1; i <= 5; i++) {
                    stars += `<span class="star">${i <= feedback.rating ? '★' : '☆'}</span>`;
                }
                
                feedbackItem.innerHTML = `
                    <div class="feedback-header">
                        <div class="feedback-route">${feedback.route}</div>
                        <div class="feedback-date">${formattedDate}</div>
                    </div>
                    <div class="feedback-rating">${stars}</div>
                    <div class="feedback-type">${feedback.feedbackType}</div>
                    <p>${feedback.feedbackText}</p>
                `;
                
                pastFeedbackList.appendChild(feedbackItem);
            });
        }
        
        // Function to load implemented suggestions
        function loadImplementations() {
            const implementationsList = document.getElementById('implementations-list');
            
            // Sample implementation data (in a real app, this would come from a server)
            const implementations = [
                {
                    title: "WiFi on All Express Routes",
                    description: "Based on your feedback, we've installed high-speed WiFi on all express routes between major cities.",
                    date: "February 2025",
                    icon: "📡"
                },
                {
                    title: "Real-time Bus Tracking",
                    description: "You asked for better journey updates. Our new mobile app now shows real-time location of your bus.",
                    date: "January 2025",
                    icon: "🔍"
                },
                {
                    title: "Improved Luggage Storage",
                    description: "Many of you suggested better luggage compartments. We've redesigned our buses with larger, more secure storage areas.",
                    date: "December 2024",
                    icon: "🧳"
                },
                {
                    title: "On-board Refreshments",
                    description: "You asked for refreshments on longer journeys. We now offer complimentary water and snacks on routes over 3 hours.",
                    date: "November 2024",
                    icon: "🥤"
                }
            ];
            
            // Clear existing content
            implementationsList.innerHTML = '';
            
            // Render implementation items
            implementations.forEach(implementation => {
                const implementationItem = document.createElement('div');
                implementationItem.className = 'implementation-item';
                
                implementationItem.innerHTML = `
                    <div class="implementation-icon">${implementation.icon}</div>
                    <div class="implementation-content">
                        <div class="implementation-title">${implementation.title}</div>
                        <div class="implementation-date">${implementation.date}</div>
                        <p>${implementation.description}</p>
                    </div>
                `;
                
                implementationsList.appendChild(implementationItem);
            });
        }
        
        // Function to show floating notification
        function showNotification(message) {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.style.display = 'block';
            
            // Fade in
            setTimeout(() => {
                notification.style.opacity = '1';
            }, 10);
            
            // Fade out after 3 seconds
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 300);
            }, 3000);
        }
    </script>
</body>
</html