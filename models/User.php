<?php
require_once '../utils/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function register($username, $password) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        $stmt->execute(['username' => $username, 'password' => $hashed_password]);
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getAllGameStats($user_id) {
        $modes = ['flag', 'currency', 'language', 'location', 'capital'];
        $stats = [];

        foreach ($modes as $mode) {
            $stmt = $this->db->prepare('SELECT score, date_played FROM game_stats WHERE user_id = :user_id AND mode = :mode ORDER BY date_played');
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':mode', $mode);
            $stmt->execute();
            $stats[$mode] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $stats;
    }

    public function changePassword($user_id, $current_password, $new_password) {
        $stmt = $this->db->prepare('SELECT password FROM users WHERE id = :user_id');
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($current_password, $user['password'])) {
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $stmt = $this->db->prepare('UPDATE users SET password = :password WHERE id = :user_id');
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            return true;
        }

        return false;
    }
}
?>
