<?php

use App\Controllers\AuthController;
use App\Controllers\PageController;

$authController = new AuthController();
$pageController = new PageController();

// Routes Authentification
if ($_SERVER['REQUEST_URI'] === '/auth/login' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $authController->showLoginForm();
} elseif ($_SERVER['REQUEST_URI'] === '/auth/register' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $authController->showRegisterForm();
} elseif ($_SERVER['REQUEST_URI'] === '/auth/login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController->login($_POST['username'], $_POST['password']);
} elseif ($_SERVER['REQUEST_URI'] === '/auth/register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController->register($_POST['username'], $_POST['password']);
} elseif ($_SERVER['REQUEST_URI'] === '/auth/logout') {
    $authController->logout();
    header('Location: /auth/login');
    exit();

} elseif ($_SERVER['REQUEST_URI'] === '/') {
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: /auth/login');
        exit();
    }
    $pageController->showHomePage();
} else {
    echo "404 - Page non trouvée";
}
