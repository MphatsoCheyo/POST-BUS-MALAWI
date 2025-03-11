<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
   
</head>
<body class="body">
    <!-- Your existing HTML content remains the same -->
    <div class="containerr">
        <div id="registerForm">
            <h2 class="title">Register</h2>
            <form id="register" method="POST" action="register.php">
                <div class="form-group">
                    <label for="reg-name">Full Name</label>
                    <input type="text" id="reg-name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="reg-email">Email</label>
                    <input type="email" id="reg-email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="reg-phone">Phone Number</label>
                    <input type="tel" id="reg-phone" name="phone" required>
                </div>
               
                <div class="form-group">
                    <label for="reg-date_of_birth">Date of Birth</label>
                    <input type="date" id="reg-date_of_birth" name="date_of_birth" required>
                </div>
                <div class="form-group">
                    <label for="reg-password">Password</label>
                    <input type="password" id="reg-password" name="password" required>
                </div>
                <button type="submit" class="button">Register</button>
                <div class="switch-form">
                    Already have an account? <a href="login.php" onclick="toggleForms('loginForm')">Login</a>
                </div>
            </form>
        </div>
    </div>


</body>
</html>