<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="../public/css/register.css">
    <script src="../public/js/register.js"></script>

</head>
<body>
    <div class="register-container">
        <form class="register-form" action="index.php?action=register" method="post" onsubmit="return validateForm()">
            <h2>Register</h2>
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="input-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>
            <button type="submit" class="register-button">Register</button>
            <div class="links">
                <a href="index.php?action=login">Login</a>
            </div>
        </form>
    </div>
</body>
</html>
