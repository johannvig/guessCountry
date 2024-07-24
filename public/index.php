<?php
require_once '../controllers/UserController.php';
require_once '../controllers/GameController.php';
require_once '../controllers/ProfileController.php';

session_start();

$action = isset($_GET['action']) ? $_GET['action'] : null;

switch ($action) {
    case 'login':
        $userController = new UserController();
        $userController->login();
        break;

    case 'register':
        $userController = new UserController();
        $userController->register();
        break;

    case 'play':
        $gameController = new GameController();
        $gameController->play();
        break;

    case 'profile':
        $profileController = new ProfileController();
        $profileController->showProfile();
        break;

    case 'change_password':
        $profileController = new ProfileController();
        $profileController->changePassword();
        break;

    case 'logout':
        $userController = new UserController();
        $userController->logout();
        break;

    default:
        include '../views/menu.php';
        break;
}
?>
