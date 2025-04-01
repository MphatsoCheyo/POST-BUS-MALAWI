<?php
$page_name = 'booking';  // Set the current page name
include('../pages/header.php');
?>
<style>

  
</style>
</head>

<body>
    <div class="app-conttainer">
    
        <div class="tab-navigation">
            <div class="tab-item active" data-tab="profile">Profile</div>
            <div class="tab-item" data-tab="loyalty">Loyalty</div>
            <div class="tab-item" data-tab="badges">Badges</div>
        </div>

        <div class="tab-content active" id="profile-tab">
            <div class="profile-header">
                <div class="profile-image">
                    <img src="https://randomuser.me/api/portraits/women/42.jpg" alt="Profile Photo">
                    <div class="profile-edit-icon">
                        <i class="fas fa-camera"></i>
                    </div>
                </div>
                <h2 class="profile-name">Sarah Johnson</h2>
                <p class="profile-email">sarah.johnson@example.com</p>
                <div class="profile-status">
                    <span class="profile-tier tier-gold">Gold Member</span>
                </div>
            </div>

            <div class="profile-form">
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" value="Sarah Johnson">
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" value="sarah.johnson@example.com">
                </div>
                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" value="+1 (555) 123-4567">
                </div>
                <div class="form-group">
                    <label class="form-label">Birthday</label>
                    <input type="date" class="form-control" value="1992-05-15">
                </div>
                <button class="form-submit">Save Changes</button>
            </div>
        </div>

        <div class="tab-content" id="loyalty-tab">
            <div class="loyalty-header">
                <div class="loyalty-points">2,560 <small>points</small></div>
                <div class="loyalty-progress">
                    <div class="loyalty-progress-label">
                        <span>Gold Member</span>
                        <span>2,560 / 5,000 to Platinum</span>
                    </div>
                    <div class="loyalty-progress-bar">
                        <div class="loyalty-progress-fill" style="width: 51%;"></div>
                    </div>
                </div>
            </div>

            <div class="loyalty-tiers">
                <h3 class="loyalty-tier-title">Member Tiers</h3>
                <div class="loyalty-tier">
                    <div class="loyalty-tier-header">
                        <div class="loyalty-tier-name">
                            <div class="loyalty-tier-icon" style="background-color: var(--silver-color);">S</div>
                            Silver
                        </div>
                        <div class="loyalty-tier-points">0 points</div>
                    </div>
                    <div class="loyalty-tier-benefits">
                        <div class="loyalty-tier-benefit">
                            <span class="benefit-icon"><i class="fas fa-check"></i></span>
                            <span>Free standard shipping</span>
                        </div>
                        <div class="loyalty-tier-benefit">
                            <span class="benefit-icon"><i class="fas fa-check"></i></span>
                            <span>Birthday reward</span>
                        </div>
                    </div>
                </div>

                <div class="loyalty-tier active">
                    <div class="loyalty-tier-header">
                        <div class="loyalty-tier-name">
                            <div class="loyalty-tier-icon" style="background-color: var(--gold-color);">G</div>
                            Gold
                        </div>
                        <div class="loyalty-tier-points">1,000 points</div>
                    </div>
                    <div class="loyalty-tier-benefits">
                        <div class="loyalty-tier-benefit">
                            <span class="benefit-icon"><i class="fas fa-check"></i></span>
                            <span>All Silver benefits</span>
                        </div>
                        <div class="loyalty-tier-benefit">
                            <span class="benefit-icon"><i class="fas fa-check"></i></span>
                            <span>Free expedited shipping</span>
                        </div>
                        <div class="loyalty-tier-benefit">
                            <span class="benefit-icon"><i class="fas fa-check"></i></span>
                            <span>Early access to sales</span>
                        </div>
                    </div>
                </div>

                <div class="loyalty-tier">
                    <div class="loyalty-tier-header">
                        <div class="loyalty-tier-name">
                            <div class="loyalty-tier-icon" style="background-color: var(--platinum-color);">P</div>
                            Platinum
                        </div>
                        <div class="loyalty-tier-points">5,000 points</div>
                    </div>
                    <div class="loyalty-tier-benefits">
                        <div class="loyalty-tier-benefit">
                            <span class="benefit-icon"><i class="fas fa-check"></i></span>
                            <span>All Gold benefits</span>
                        </div>
                        <div class="loyalty-tier-benefit">
                            <span class="benefit-icon"><i class="fas fa-check"></i></span>
                            <span>Free priority shipping</span>
                        </div>
                        <div class="loyalty-tier-benefit">
                            <span class="benefit-icon"><i class="fas fa-check"></i></span>
                            <span>Dedicated customer service</span>
                        </div>
                    </div>
                </div>

                <div class="loyalty-tier">
                    <div class="loyalty-tier-header">
                        <div class="loyalty-tier-name">
                            <div class="loyalty-tier-icon" style="background-color: var(--diamond-color);">D</div>
                            Diamond
                        </div>
                        <div class="loyalty-tier-points">10,000 points</div>
                    </div>
                    <div class="loyalty-tier-benefits">
                        <div class="loyalty-tier-benefit">
                            <span class="benefit-icon"><i class="fas fa-check"></i></span>
                            <span>All Platinum benefits</span>
                        </div>
                        <div class="loyalty-tier-benefit">
                            <span class="benefit-icon"><i class="fas fa-check"></i></span>
                            <span>Exclusive events and products</span>
                        </div>
                        <div class="loyalty-tier-benefit">
                            <span class="benefit-icon"><i class="fas fa-check"></i></span>
                            <span>Personalized shopping experience</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content" id="badges-tab">
            <div class="badges-container">
                <h3 class="badges-title">Your Achievements</h3>
                <div class="badges-grid">
                    <div class="badge-item unlocked">
                        <div class="badge-icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="badge-name">First Purchase</div>
                        <div class="badge-status">Unlocked</div>
                    </div>
                    <div class="badge-item unlocked">
                        <div class="badge-icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <div class="badge-name">Referral</div>
                        <div class="badge-status">Unlocked</div>
                    </div>
                    <div class="badge-item unlocked">
                        <div class="badge-icon">
                            <i class="fas fa-birthday-cake"></i>
                        </div>
                        <div class="badge-name">Birthday Reward</div>
                        <div class="badge-status">Unlocked</div>
                    </div>
                    <div class="badge-item locked">
                        <div class="badge-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="badge-name">Rate & Review</div>
                        <div class="badge-status">Locked</div>
                    </div>
                    <div class="badge-item locked">
                        <div class="badge-icon">
                            <i class="fas fa-share-alt"></i>
                        </div>
                        <div class="badge-name">Social Share</div>
                        <div class="badge-status">Locked</div>
                    </div>
                    <div class="badge-item locked">
                        <div class="badge-icon">
                            <i class="fas fa-crown"></i>
                        </div>
                        <div class="badge-name">Diamond Status</div>
                        <div class="badge-status">Locked</div>
                    </div>
                </div>
            </div>

            <div class="badges-container mt-20">
                <h3 class="badges-title">Points History</h3>
                <div class="history-item">
                    <div class="history-header">
                        <div class="history-title">Online Purchase</div>
                        <div class="history-points">+500 pts</div>
                    </div>
                    <div class="history-date">March 12, 2025</div>
                    <div class="history-description">Purchase #12345 - Spring Collection</div>
                </div>
                <div class="history-item">
                    <div class="history-header">
                        <div class="history-title">Referral Bonus</div>
                        <div class="history-points">+250 pts</div>
                    </div>
                    <div class="history-date">March 5, 2025</div>
                    <div class="history-description">Friend signup: Emily Roberts</div>
                </div>
                <div class="history-item">
                    <div class="history-header">
                        <div class="history-title">Survey Completion</div>
                        <div class="history-points">+100 pts</div>
                    </div>
                    <div class="history-date">February 28, 2025</div>
                    <div class="history-description">Customer satisfaction survey</div>
                </div>
            </div>
        </div>

        <!-- Notification -->
        <div class="notification notification-success">
            <div class="notification-icon"><i class="fas fa-check-circle"></i></div>
            <div class="notification-message">Profile updated successfully!</div>
        </div>

        <!-- Modal Example -->
        <div class="modal" id="settings-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Settings</div>
                    <div class="modal-close"><i class="fas fa-times"></i></div>
                </div>
                <div class="settings-section">
                    <h4 class="settings-title">Notifications</h4>
                    <div class="settings-item">
                        <div class="settings-item-label">
                            <div class="settings-item-icon"><i class="fas fa-bell"></i></div>
                            <div class="settings-item-text">Push Notifications</div>
                        </div>
                        <div class="settings-item-action">
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                    <div class="settings-item">
                        <div class="settings-item-label">
                            <div class="settings-item-icon"><i class="fas fa-envelope"></i></div>
                            <div class="settings-item-text">Email Notifications</div>
                        </div>
                        <div class="settings-item-action">
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="settings-section">
                    <h4 class="settings-title">Account</h4>
                    <div class="settings-item">
                        <div class="settings-item-label">
                            <div class="settings-item-icon"><i class="fas fa-lock"></i></div>
                            <div class="settings-item-text">Change Password</div>
                        </div>
                        <div class="settings-item-action">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                    <div class="settings-item">
                        <div class="settings-item-label">
                            <div class="settings-item-icon"><i class="fas fa-palette"></i></div>
                            <div class="settings-item-text">App Theme</div>
                        </div>
                        <div class="settings-item-action">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include('../pages/footer.php');  // Include footer.php
    ?>

    <script>
        // Tab Navigation
        const tabItems = document.querySelectorAll('.tab-item');
        const tabContents = document.querySelectorAll('.tab-content');

        tabItems.forEach(item => {
            item.addEventListener('click', () => {
                const tabName = item.getAttribute('data-tab');

                // Remove active class from all tabs
                tabItems.forEach(tab => tab.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Add active class to selected tab
                item.classList.add('active');
                document.getElementById(`${tabName}-tab`).classList.add('active');
            });
        });

        // Profile Form Submission
        const profileForm = document.querySelector('.profile-form');
        const formSubmit = document.querySelector('.form-submit');
        const notification = document.querySelector('.notification');

        formSubmit.addEventListener('click', (e) => {
            e.preventDefault();

            // Show notification
            notification.classList.add('active');

            // Hide notification after 3 seconds
            setTimeout(() => {
                notification.classList.remove('active');
            }, 3000);
        });

        // Modal Controls
        const settingsIcon = document.querySelector('.fa-cog');
        const settingsModal = document.getElementById('settings-modal');
        const modalClose = document.querySelector('.modal-close');

        settingsIcon.addEventListener('click', () => {
            settingsModal.classList.add('active');
        });

        modalClose.addEventListener('click', () => {
            settingsModal.classList.remove('active');
        });

        // Close modal when clicking outside
        settingsModal.addEventListener('click', (e) => {
            if (e.target === settingsModal) {
                settingsModal.classList.remove('active');
            }
        });

        // Bottom Navigation
        const bottomNavItems = document.querySelectorAll('.bottom-nav-item');

        bottomNavItems.forEach(item => {
            item.addEventListener('click', () => {
                bottomNavItems.forEach(navItem => navItem.classList.remove('active'));
                item.classList.add('active');
            });
        });

        // Progress Bar Animation
        const progressBars = document.querySelectorAll('.loyalty-progress-fill');

        function animateProgressBars() {
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 300);
            });
        }

        // Animate progress bars when loyalty tab is clicked
        document.querySelector('[data-tab="loyalty"]').addEventListener('click', animateProgressBars);

        // Initialize the app
        document.addEventListener('DOMContentLoaded', () => {
            // Simulate loading state
            setTimeout(animateProgressBars, 500);

            // Add pulse effect to new badges
            const newBadges = document.querySelectorAll('.badge-item.unlocked');
            newBadges[newBadges.length - 1].classList.add('pulse');
        });
    </script>
</body>

</html>