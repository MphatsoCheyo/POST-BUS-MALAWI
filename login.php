<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="body">
    <div class="containerr">
    <div id="loginForm">
            <h2 class="title">Login</h2>
            <form id="login" method="POST" action="log.php">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <input type="checkbox" name="remember_me"> Remember me
                <button type="submit" class="button">Login</button>
                <div class="switch-form">
                    Don't have an account? <a href="reg.php" onclick="toggleForms('registerForm')">Register</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>