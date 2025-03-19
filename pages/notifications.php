<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications & Alerts - Post Bus Malawi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root {
            --primary-color: #0056b3;
            --secondary-color: #e8f4ff;
            --accent-color: #ff6b00;
            --text-color: #333;
            --light-gray: #f5f5f5;
            --border-color: #ddd;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: var(--text-color);
        }

        .container {
            max-width: 480px;
            margin: 0 auto;
            background-color: white;
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        /* Header */
        .header {
            background-color: var(--primary-color);
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header h1 {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .menu-icon {
            cursor: pointer;
        }

        /* Notification section */
        .notification-section {
            padding: 15px;
        }

        .section-title {
            font-size: 1.1rem;
            margin-bottom: 15px;
            color: var(--primary-color);
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 8px;
            color: var(--accent-color);
        }

        /* Notification items */
        .notification-item {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            border-left: 4px solid var(--primary-color);
            position: relative;
        }

        .notification-item.unread {
            background-color: var(--secondary-color);
        }

        .notification-item.promotional {
            border-left-color: var(--accent-color);
        }

        .notification-item.deadline {
            border-left-color: #e74c3c;
        }

        .notification-title {
            font-weight: 600;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .notification-timestamp {
            font-size: 0.8rem;
            color: #777;
        }

        .notification-content {
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .notification-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        .notification-btn {
            background-color: transparent;
            border: none;
            color: var(--primary-color);
            padding: 5px 10px;
            font-size: 0.8rem;
            cursor: pointer;
            border-radius: 4px;
        }

        .notification-btn:hover {
            background-color: var(--secondary-color);
        }

        /* Settings section */
        .settings-section {
            padding: 15px;
            background-color: var(--light-gray);
            border-radius: 8px;
            margin: 15px;
        }

        .settings-title {
            font-weight: 600;
            margin-bottom: 15px;
        }

        .settings-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .settings-item:last-child {
            border-bottom: none;
        }

        .settings-item-label {
            font-size: 0.9rem;
        }

        /* Toggle switch */
        .switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: var(--primary-color);
        }

        input:checked + .slider:before {
            transform: translateX(20px);
        }

        /* Nav drawer */
        .nav-drawer {
            position: fixed;
            top: 0;
            left: -280px;
            width: 280px;
            height: 100%;
            background-color: white;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            transition: left 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }

        .nav-drawer.open {
            left: 0;
        }

        .nav-header {
            background-color: var(--primary-color);
            color: white;
            padding: 20px 15px;
        }

        .nav-header h2 {
            font-size: 1.3rem;
            margin-bottom: 5px;
        }

        .nav-header p {
            font-size: 0.8rem;
            opacity: 0.8;
        }

        .nav-item {
            display: block;
            padding: 15px;
            text-decoration: none;
            color: var(--text-color);
            border-bottom: 1px solid var(--border-color);
        }

        .nav-item i {
            margin-right: 10px;
            color: var(--primary-color);
            width: 20px;
            text-align: center;
        }

        .nav-item:hover {
            background-color: var(--light-gray);
        }

        .nav-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .nav-backdrop.visible {
            display: block;
        }

        /* Clear All button */
        .clear-all-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            margin: 0 15px 15px 15px;
            width: calc(100% - 30px);
            cursor: pointer;
            font-weight: 500;
        }

        .clear-all-btn:hover {
            background-color: #004494;
        }

        /* Badge */
        .badge {
            background-color: var(--accent-color);
            color: white;
            font-size: 0.7rem;
            padding: 2px 8px;
            border-radius: 10px;
            margin-left: 8px;
        }

        /* Empty state */
        .empty-state {
            display: none;
            text-align: center;
            padding: 30px 15px;
        }

        .empty-state i {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 15px;
        }

        .empty-state p {
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="menu-icon" id="menuToggle">
                <i class="fas fa-bars"></i>
            </div>
            <h1>Notifications & Alerts</h1>
            <div></div>
        </div>

        <div class="notification-section">
            <div class="section-title">
                <i class="fas fa-bell"></i> Recent Notifications
                <span class="badge" id="notificationCount">3</span>
            </div>
            
            <div id="notificationsList">
                <div class="notification-item unread deadline">
                    <div class="notification-title">
                        <span>Loyalty Points Expiring Soon</span>
                        <span class="notification-timestamp">Today, 10:45 AM</span>
                    </div>
                    <div class="notification-content">
                        Your 500 loyalty points will expire in 7 days. Book a trip now to use them!
                    </div>
                    <div class="notification-actions">
                        <button class="notification-btn book-now-btn">Book Now</button>
                        <button class="notification-btn dismiss-btn">Dismiss</button>
                    </div>
                </div>

                <div class="notification-item unread promotional">
                    <div class="notification-title">
                        <span>Weekend Special Offer</span>
                        <span class="notification-timestamp">Yesterday, 5:30 PM</span>
                    </div>
                    <div class="notification-content">
                        Get 20% off on all weekend trips from Lilongwe to Blantyre! Book before Friday.
                    </div>
                    <div class="notification-actions">
                        <button class="notification-btn book-now-btn">Book Now</button>
                        <button class="notification-btn dismiss-btn">Dismiss</button>
                    </div>
                </div>

                <div class="notification-item unread">
                    <div class="notification-title">
                        <span>Bus LLW-212 Delayed</span>
                        <span class="notification-timestamp">Yesterday, 3:15 PM</span>
                    </div>
                    <div class="notification-content">
                        Your bus from Lilongwe to Zomba is delayed by 30 minutes due to traffic conditions.
                    </div>
                    <div class="notification-actions">
                        <button class="notification-btn track-btn">Track Bus</button>
                        <button class="notification-btn dismiss-btn">Dismiss</button>
                    </div>
                </div>

                <div class="notification-item">
                    <div class="notification-title">
                        <span>Trip Reminder</span>
                        <span class="notification-timestamp">June 12, 9:00 AM</span>
                    </div>
                    <div class="notification-content">
                        Reminder: Your trip from Blantyre to Mzuzu is scheduled for tomorrow at 7:00 AM. Please arrive 30 minutes before departure.
                    </div>
                    <div class="notification-actions">
                        <button class="notification-btn view-ticket-btn">View Ticket</button>
                        <button class="notification-btn dismiss-btn">Dismiss</button>
                    </div>
                </div>
            </div>

            <div class="empty-state" id="emptyState">
                <i class="far fa-bell-slash"></i>
                <p>You have no notifications at this time</p>
            </div>

            <button class="clear-all-btn" id="clearAllBtn">Clear All Notifications</button>
        </div>

        <div class="settings-section">
            <div class="settings-title">Notification Preferences</div>
            
            <div class="settings-item">
                <span class="settings-item-label">Delay Notifications</span>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider"></span>
                </label>
            </div>

            <div class="settings-item">
                <span class="settings-item-label">Promotional Offers</span>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider"></span>
                </label>
            </div>

            <div class="settings-item">
                <span class="settings-item-label">Loyalty Points Alerts</span>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider"></span>
                </label>
            </div>

            <div class="settings-item">
                <span class="settings-item-label">Trip Reminders</span>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider"></span>
                </label>
            </div>

            <div class="settings-item">
                <span class="settings-item-label">Price Drop Alerts</span>
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider"></span>
                </label>
            </div>
        </div>
    </div>

    <!-- Navigation Drawer -->
    <div class="nav-drawer" id="navDrawer">
        <div class="nav-header">
            <h2>Post Bus Malawi</h2>
            <p>Welcome, John Banda</p>
        </div>
        <a href="index.php" class="nav-item"><i class="fas fa-home"></i> Home</a>
        <a href="booking.php" class="nav-item"><i class="fas fa-ticket-alt"></i> Book a Ticket</a>
        <a href="schedule.php" class="nav-item"><i class="fas fa-clock"></i> Check Schedule</a>
        <a href="truck.php" class="nav-item"><i class="fas fa-bus"></i> Track Bus</a>
        <a href="seat.php" class="nav-item"><i class="fas fa-chair"></i> Select a Seat</a>
        <a href="payment.php" class="nav-item"><i class="fas fa-credit-card"></i> Payment Options</a>
        <a href="qrcode.php" class="nav-item"><i class="fas fa-qrcode"></i> QR Code Generation</a>
        <a href="customer.php" class="nav-item"><i class="fas fa-headset"></i> Customer Support</a>
        <a href="profile.php" class="nav-item"><i class="fas fa-user"></i> User Profile</a>
        <a href="travel.php" class="nav-item"><i class="fas fa-history"></i> Travel History</a>
        <a href="feedback.php" class="nav-item"><i class="fas fa-star"></i> Feedback & Ratings</a>
        <a href="notifications.php" class="nav-item active"><i class="fas fa-bell"></i> Notifications & Alerts</a>
    </div>
    <div class="nav-backdrop" id="navBackdrop"></div>

    <script>
        // DOM elements
        const menuToggle = document.getElementById('menuToggle');
        const navDrawer = document.getElementById('navDrawer');
        const navBackdrop = document.getElementById('navBackdrop');
        const notificationItems = document.querySelectorAll('.notification-item');
        const dismissButtons = document.querySelectorAll('.dismiss-btn');
        const clearAllBtn = document.getElementById('clearAllBtn');
        const notificationsList = document.getElementById('notificationsList');
        const emptyState = document.getElementById('emptyState');
        const notificationCount = document.getElementById('notificationCount');
        
        // Toggle navigation drawer
        menuToggle.addEventListener('click', function() {
            navDrawer.classList.add('open');
            navBackdrop.classList.add('visible');
        });
        
        navBackdrop.addEventListener('click', function() {
            navDrawer.classList.remove('open');
            navBackdrop.classList.remove('visible');
        });
        
        // Dismiss individual notifications
        dismissButtons.forEach(button => {
            button.addEventListener('click', function() {
                const notificationItem = this.closest('.notification-item');
                notificationItem.style.opacity = '0';
                notificationItem.style.height = '0';
                notificationItem.style.marginBottom = '0';
                notificationItem.style.padding = '0';
                notificationItem.style.overflow = 'hidden';
                notificationItem.style.transition = 'all 0.3s ease';
                
                setTimeout(() => {
                    notificationItem.remove();
                    updateNotificationCount();
                    checkEmptyState();
                }, 300);
            });
        });
        
        // Clear all notifications
        clearAllBtn.addEventListener('click', function() {
            const notifications = document.querySelectorAll('.notification-item');
            
            notifications.forEach(notification => {
                notification.style.opacity = '0';
                notification.style.height = '0';
                notification.style.marginBottom = '0';
                notification.style.padding = '0';
                notification.style.overflow = 'hidden';
                notification.style.transition = 'all 0.3s ease';
            });
            
            setTimeout(() => {
                notificationsList.innerHTML = '';
                updateNotificationCount();
                checkEmptyState();
            }, 300);
        });
        
        // Action buttons
        const bookNowButtons = document.querySelectorAll('.book-now-btn');
        bookNowButtons.forEach(button => {
            button.addEventListener('click', function() {
                window.location.href = 'booking.php';
            });
        });
        
        const trackButtons = document.querySelectorAll('.track-btn');
        trackButtons.forEach(button => {
            button.addEventListener('click', function() {
                window.location.href = 'truck.php';
            });
        });
        
        const viewTicketButtons = document.querySelectorAll('.view-ticket-btn');
        viewTicketButtons.forEach(button => {
            button.addEventListener('click', function() {
                window.location.href = 'qrcode.php';
            });
        });
        
        // Toggle switch functionality
        const toggleSwitches = document.querySelectorAll('.switch input');
        toggleSwitches.forEach(toggle => {
            toggle.addEventListener('change', function() {
                const settingName = this.closest('.settings-item').querySelector('.settings-item-label').textContent;
                const isEnabled = this.checked;
                console.log(`Setting "${settingName}" is now ${isEnabled ? 'enabled' : 'disabled'}`);
                
                // You would typically save this to user preferences via AJAX
                // saveUserPreference(settingName, isEnabled);
            });
        });
        
        // Update notification count
        function updateNotificationCount() {
            const unreadCount = document.querySelectorAll('.notification-item.unread').length;
            notificationCount.textContent = unreadCount;
            
            // Hide badge if no unread notifications
            if (unreadCount === 0) {
                notificationCount.style.display = 'none';
            } else {
                notificationCount.style.display = 'inline-block';
            }
        }
        
        // Check if notifications list is empty
        function checkEmptyState() {
            const hasNotifications = document.querySelectorAll('.notification-item').length > 0;
            
            if (hasNotifications) {
                emptyState.style.display = 'none';
                clearAllBtn.style.display = 'block';
            } else {
                emptyState.style.display = 'block';
                clearAllBtn.style.display = 'none';
            }
        }
        
        // Mark notification as read when clicked
        notificationItems.forEach(item => {
            item.addEventListener('click', function(e) {
                // Don't mark as read if clicking on buttons
                if (e.target.classList.contains('notification-btn')) {
                    return;
                }
                
                if (this.classList.contains('unread')) {
                    this.classList.remove('unread');
                    updateNotificationCount();
                }
            });
        });
        
        // Sample function to add a new notification (for demo purposes)
        function addNewNotification(title, content, type = '', isUnread = true) {
            const newNotification = document.createElement('div');
            newNotification.className = `notification-item ${isUnread ? 'unread' : ''} ${type}`;
            
            const now = new Date();
            const timeString = `${now.getHours()}:${now.getMinutes().toString().padStart(2, '0')} ${now.getHours() >= 12 ? 'PM' : 'AM'}`;
            
            newNotification.innerHTML = `
                <div class="notification-title">
                    <span>${title}</span>
                    <span class="notification-timestamp">Today, ${timeString}</span>
                </div>
                <div class="notification-content">
                    ${content}
                </div>
                <div class="notification-actions">
                    <button class="notification-btn view-details-btn">View Details</button>
                    <button class="notification-btn dismiss-btn">Dismiss</button>
                </div>
            `;
            
            notificationsList.prepend(newNotification);
            updateNotificationCount();
            checkEmptyState();
            
            // Add event listener to new dismiss button
            const newDismissBtn = newNotification.querySelector('.dismiss-btn');
            newDismissBtn.addEventListener('click', function() {
                newNotification.style.opacity = '0';
                newNotification.style.height = '0';
                newNotification.style.marginBottom = '0';
                newNotification.style.padding = '0';
                newNotification.style.overflow = 'hidden';
                newNotification.style.transition = 'all 0.3s ease';
                
                setTimeout(() => {
                    newNotification.remove();
                    updateNotificationCount();
                    checkEmptyState();
                }, 300);
            });
            
            // Mark as read when clicked
            newNotification.addEventListener('click', function(e) {
                if (e.target.classList.contains('notification-btn')) {
                    return;
                }
                
                if (this.classList.contains('unread')) {
                    this.classList.remove('unread');
                    updateNotificationCount();
                }
            });
        }
        
        // Simulate a new notification after 10 seconds for demo purposes
        setTimeout(() => {
            addNewNotification(
                'New Route Added', 
                'A new route from Lilongwe to Nkhata Bay is now available for booking!',
                'promotional',
                true
            );
        }, 10000);
    </script>
</body>
</html>