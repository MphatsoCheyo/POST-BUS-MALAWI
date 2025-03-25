<?php
$page_name = isset($page_name) ? $page_name : ''; // Default to an empty string if not passed
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Post Bus Malawi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>
<body>
    <header>
        <button class="logout-btn" onclick="logout()" title="Logout">
            <i class="fas fa-sign-out-alt"></i>
        </button>
        <div class="hamburger" onclick="toggleNav()">
            <i class="fas fa-bars"></i>
        </div>
        <img src="../images/m.webp" alt="Post Bus Malawi Logo" class="logo">
    </header>
    
    <div class="nav-drawer" id="navDrawer">
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
    <a href="notifications.php" class="nav-item"><i class="fas fa-bell"></i> Notifications & Alerts</a>
</div>
</body>
</html>
