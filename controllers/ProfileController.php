<?php
require_once '../models/User.php';

class ProfileController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function showProfile() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit();
        }

        $user_id = $_SESSION['user_id'];
        $stats = $this->userModel->getAllGameStats($user_id);
        include '../views/profile.php';
    }

    public function changePassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $current_password = $_POST['current_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            if ($new_password !== $confirm_password) {
                $error = "New passwords do not match.";
                include '../views/profile.php';
                return;
            }

            $user_id = $_SESSION['user_id'];
            $result = $this->userModel->changePassword($user_id, $current_password, $new_password);

            if ($result) {
                $message = "Password successfully changed.";
            } else {
                $error = "Current password is incorrect.";
            }
        }

        $this->showProfile();
    }
}
?>
