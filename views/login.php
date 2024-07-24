<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../public/css/login.css">
</head>
<body>
    <div class="login-container">
        <form class="login-form" action="index.php?action=login" method="post">
            <h2>Login</h2>
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="login-button">Login</button>
            <div class="links">
                <a href="index.php?action=register">Register</a> | 
                <a href="index.php?action=menu">Play without an account</a>
            </div>
        </form>
    </div>
</body>
</html>
