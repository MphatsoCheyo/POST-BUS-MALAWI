<?php
$page_name = 'booking';  // Set the current page name
include('../pages/header.php');
?>
<style>

    .app-container {
        width: 60%;
        margin: 0 auto;
        background-color: white;
        min-height: 100vh;
        position: relative;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .tab-navigation {
        display: flex;
        background-color: white;
        border-bottom: 1px solid var(--border-color);
        position: sticky;
        top: 56px;
        z-index: 9;
    }

    .tab-item {
        flex: 1;
        text-align: center;
        padding: 12px 0;
        cursor: pointer;
        font-weight: 500;
        color: var(--light-text);
        border-bottom: 2px solid transparent;
        transition: all 0.3s;
    }

    .tab-item.active {
        color: var(--primary-color);
        border-bottom-color: var(--primary-color);
    }

    .tab-content {
        display: none;
        padding: 20px;
    }

    .tab-content.active {
        display: block;
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    /* Profile Section */
    .profile-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px 0;
        margin-bottom: 20px;
        padding: 15px;
        border-left: 4px solid var(--secondary-color);
        background-color: var(--white);
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .profile-image {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid var(--primary-color);
        position: relative;
    }

    .profile-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-edit-icon {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background-color: var(--primary-color);
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .profile-name {
        font-size: 1.4rem;
        font-weight: 600;
        margin-top: 15px;
    }

    .profile-email {
        color: var(--light-text);
        font-size: 0.9rem;
    }

    .profile-status {
        margin-top: 10px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .profile-tier {
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .tier-silver {
        background-color: var(--silver-color);
        color: white;
    }

    .tier-gold {
        background-color: var(--gold-color);
        color: var(--text-color);
    }

    .tier-platinum {
        background-color: var(--platinum-color);
        color: var(--text-color);
    }

    .tier-diamond {
        background-color: var(--diamond-color);
        color: white;
    }

    .profile-form {
        margin-top: 30px;
    }

    .form-group {
        margin-bottom: 15px;
        margin-bottom: 20px;
        padding: 15px;
        border-left: 4px solid var(--secondary-color);
        background-color: var(--white);
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--light-text);
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-size: 1rem;
        outline: none;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: var(--primary-color);
    }

    .form-submit {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 1rem;
        cursor: pointer;
        width: 100%;
        margin-top: 15px;
        transition: background-color 0.3s;
    }

    .form-submit:hover {
        background-color: var(--secondary-color);
    }

    /* Login Section */
    .login-container {
        padding: 20px 0;
    }

    .login-message {
        margin-bottom: 25px;
        font-size: 0.9rem;
        color: var(--light-text);
        text-align: center;
    }

    .login-options {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .login-option {
        padding: 12px 15px;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        background-color: white;
        display: flex;
        align-items: center;
        gap: 15px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .login-option:hover {
        background-color: var(--light-bg);
    }

    .login-icon {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-google {
        color: #DB4437;
    }

    .login-facebook {
        color: #4267B2;
    }

    .login-apple {
        color: #000000;
    }

    .login-email {
        color: var(--primary-color);
    }

    .login-option-text {
        font-weight: 500;
    }

    .login-form {
        margin-top: 20px;
        display: none;
    }

    .login-form.active {
        display: block;
        animation: fadeIn 0.3s;
    }

    .login-form-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: var(--primary-color);
    }

    .login-toggle {
        margin-top: 20px;
        text-align: center;
    }

    .login-toggle-link {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
        cursor: pointer;
    }

    /* Loyalty Section */
    .loyalty-header {
        padding-bottom: 20px;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 20px;
        padding: 15px;
        border-left: 4px solid var(--secondary-color);
        background-color: var(--white);
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .loyalty-points {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .loyalty-points small {
        font-size: 1rem;
        font-weight: 400;
        color: var(--light-text);
    }

    .loyalty-progress {
        margin-top: 15px;
    }

    .loyalty-progress-label {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .loyalty-progress-bar {
        height: 15px;
        background-color: var(--border-color);
        border-radius: 10px;
        overflow: hidden;
    }

    .loyalty-progress-fill {
        height: 100%;
        background-color: var(--primary-color);
        border-radius: 10px;
        transition: width 1s ease-in-out;
    }

    .loyalty-tiers {
        margin-top: 30px;
        margin-bottom: 20px;
        padding: 15px;
        border-left: 4px solid var(--secondary-color);
        background-color: var(--white);
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .loyalty-tier-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .loyalty-tier {
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        background-color: white;
        border: 1px solid var(--border-color);
        transition: all 0.3s;
    }

    .loyalty-tier.active {
        border-color: var(--primary-color);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .loyalty-tier-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .loyalty-tier-name {
        font-weight: 600;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .loyalty-tier-icon {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        color: white;
    }

    .loyalty-tier-points {
        font-size: 0.9rem;
        color: var(--light-text);
    }

    .loyalty-tier-benefits {
        margin-top: 10px;
        font-size: 0.9rem;
    }

    .loyalty-tier-benefit {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 5px;
    }

    .benefit-icon {
        color: var(--success-color);
        font-size: 0.8rem;
        margin-top: 3px;
    }

    /* Badges Section */
    .badges-container {
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 15px;
        border-left: 4px solid var(--secondary-color);
        background-color: var(--white);
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .badges-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .badges-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    .badge-item {
        background-color: white;
        border-radius: 8px;
        padding: 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
        border: 1px solid var(--border-color);
        transition: all 0.3s;
    }

    .badge-item.unlocked {
        border-color: var(--success-color);
    }

    .badge-item.locked {
        opacity: 0.7;
    }

    .badge-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: var(--light-bg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .badge-item.unlocked .badge-icon {
        background-color: var(--primary-color);
        color: white;
    }

    .badge-name {
        font-size: 0.8rem;
        font-weight: 500;
        text-align: center;
        margin-bottom: 5px;
    }

    .badge-status {
        font-size: 0.7rem;
        color: var(--light-text);
    }

    .badge-item.unlocked .badge-status {
        color: var(--success-color);
    }

    /* Responsive Design */
    @media (max-width: 414px) {
        .app-container {
            width: 100%;
            box-shadow: none;
        }

        .profile-image {
            width: 80px;
            height: 80px;
        }

        .profile-name {
            font-size: 1.2rem;
        }
    }

    /* Animations and Effects */
    .pulse {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
    }

    .shake {
        animation: shake 0.5s;
    }

    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        10%,
        30%,
        50%,
        70%,
        90% {
            transform: translateX(-5px);
        }

        20%,
        40%,
        60%,
        80% {
            transform: translateX(5px);
        }
    }

    /* Utility Classes */
    .text-center {
        text-align: center;
    }

    .mt-10 {
        margin-top: 10px;
    }

    .mt-20 {
        margin-top: 20px;
    }

    .mb-10 {
        margin-bottom: 10px;
    }

    .mb-20 {
        margin-bottom: 20px;
    }

    /* Modal Styles */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 100;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s;
    }

    .modal.active {
        opacity: 1;
        visibility: visible;
    }

    .modal-content {
        background-color: white;
        border-radius: 12px;
        width: 90%;
        max-width: 400px;
        padding: 25px;
        transform: translateY(20px);
        transition: all 0.3s;
    }

    .modal.active .modal-content {
        transform: translateY(0);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .modal-title {
        font-size: 1.2rem;
        font-weight: 600;
    }

    .modal-close {
        font-size: 1.5rem;
        cursor: pointer;
        color: var(--light-text);
    }

    /* Notification Styles */
    .notification {
        position: fixed;
        top: 80px;
        left: 50%;
        transform: translateX(-50%);
        background-color: white;
        border-radius: 8px;
        padding: 12px 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        gap: 10px;
        z-index: 50;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s;
    }

    .notification.active {
        opacity: 1;
        visibility: visible;
    }

    .notification-icon {
        font-size: 1.2rem;
    }

    .notification-success .notification-icon {
        color: var(--success-color);
    }

    .notification-warning .notification-icon {
        color: var(--warning-color);
    }

    .notification-error .notification-icon {
        color: var(--danger-color);
    }

    .notification-message {
        font-size: 0.9rem;
    }

    /* Settings Section */
    .settings-section {
        margin-bottom: 25px;
    }

    .settings-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: var(--text-color);
    }

    .settings-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid var(--border-color);
    }

    .settings-item:last-child {
        border-bottom: none;
    }

    .settings-item-label {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .settings-item-icon {
        width: 20px;
        text-align: center;
        color: var(--primary-color);
    }

    .settings-item-text {
        font-size: 0.9rem;
    }

    .settings-item-action {
        display: flex;
        align-items: center;
    }

    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
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

    .toggle-slider:before {
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

    input:checked+.toggle-slider {
        background-color: var(--primary-color);
    }

    input:checked+.toggle-slider:before {
        transform: translateX(26px);
    }

    /* History Section */
    .history-item {
        padding: 15px 0;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 20px;
        padding: 15px;
        border-left: 4px solid var(--secondary-color);
        background-color: var(--white);
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .history-item:last-child {
        border-bottom: none;
    }

    .history-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }

    .history-title {
        font-weight: 500;
    }

    .history-date {
        font-size: 0.8rem;
        color: var(--light-text);
    }

    .history-points {
        color: var(--primary-color);
        font-weight: 600;
    }

    .history-description {
        font-size: 0.85rem;
        color: var(--light-text);
    }

    /* Footer */
    .app-footer {
        padding: 20px;
        text-align: center;
        color: var(--light-text);
        font-size: 0.8rem;
        margin-top: 40px;
        border-top: 1px solid var(--border-color);
    }
</style>
</head>

<body>
    <div class="app-container">
    
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