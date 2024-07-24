<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="../public/css/profile.css">
</head>
<body>
    <div class="profile-container">
        <h1>Profile</h1>
        <div class="stats">
            <h2>Your Statistics</h2>
            <?php foreach ($stats as $mode => $data): ?>
                <h3><?php echo ucfirst($mode); ?></h3>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $stat): ?>
                            <tr>
                                <td><?php echo $stat['date_played']; ?></td>
                                <td><?php echo $stat['score']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endforeach; ?>
        </div>
        <div class="form-container">
            <h2>Change Password</h2>
            <form method="post" action="index.php?action=change_password" onsubmit="return validateForm()">
                <div class="input-group">
                    <label for="current_password">Current Password:</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>
                <div class="input-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>
                <div class="input-group">
                    <label for="confirm_password">Confirm New Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="change-password-button">Change Password</button>
            </form>
        </div>
        <p><a href="index.php">Back to Menu</a></p>
    </div>
    <script>
        function validateForm() {
            var newPassword = document.getElementById("new_password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            if (newPassword !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
