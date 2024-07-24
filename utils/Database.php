<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'guess_country';
    private $username = 'root';
    private $password = '';
    private $conn;

    private static $instance = null;

    private function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }

    public function insertGameStats($user_id, $mode, $score) {
        $stmt = $this->conn->prepare("INSERT INTO game_stats (user_id, mode, score) VALUES (:user_id, :mode, :score)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':mode', $mode);
        $stmt->bindParam(':score', $score);
        $stmt->execute();
    }

    public function getGameStats($user_id, $mode) {
        $stmt = $this->conn->prepare("SELECT score, date_played FROM game_stats WHERE user_id = :user_id AND mode = :mode ORDER BY date_played");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':mode', $mode);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
