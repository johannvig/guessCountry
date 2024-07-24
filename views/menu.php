<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <link rel="stylesheet" type="text/css" href="../public/css/menu.css">
</head>
<body>
    <div class="menu-container">
        <h1>Choose a game mode</h1>
        <ul class="game-modes">
            <li><a href="index.php?action=play&mode=flag">🏳️ Guess the Flag</a></li>
            <li><a href="index.php?action=play&mode=currency">💰 Guess the Currency</a></li>
            <li><a href="index.php?action=play&mode=language">🗣️ Guess the Language</a></li>
            <li><a href="index.php?action=play&mode=location">🌍 Guess the Location</a></li>
            <li><a href="index.php?action=play&mode=capital">🏛️ Guess the Capital</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="index.php?action=profile">👤 Profile</a></li>
                <li><a href="index.php?action=logout">🚪 Logout</a></li>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>
