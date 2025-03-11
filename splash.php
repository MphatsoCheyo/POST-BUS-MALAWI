<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Post Bus Malawi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bod">
    <!-- Splash Screen -->
    <div class="splash-container" id="splashScreen">
        <div class="circle circle-1"></div>
        <div class="circle circle-2"></div>
        <div class="circle circle-3"></div>
        
        <div class="logo-container">
            <img src="m.webp" alt="Post Bus Malawi Logo" class="loggo">
        </div>
        
        <h2 class="tagline">Your Escape Awaits</h2>
        
        <button class="login-button" id="loginBtn">Get Started</button>
        
        <div class="bus-animation">
            <i class="fas fa-bus"></i>
        </div>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const splashScreen = document.getElementById('splashScreen');
        const loginBtn = document.getElementById('loginBtn');

        loginBtn.addEventListener('click', function() {
            splashScreen.classList.add('hide');
            setTimeout(() => {
                window.location.href = 'reg.php';
            }, 500); 
        });
    });
    </script>
</body>
</html>
