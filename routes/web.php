<?php

use App\Controllers\AuthController;
use App\Controllers\PageController;
use App\Controllers\ScoresController;
use App\Controllers\QuizController;

$authController = new AuthController();
$pageController = new PageController();
$scoresController = new ScoresController();
$quizController = new QuizController();


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
} elseif ($_SERVER['REQUEST_URI'] === '/scores') {
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: /auth/login');
        exit();
    }
    // Appeler le contrôleur pour afficher les scores de l'utilisateur
    $scoresController->showScores($_SESSION['user']['id']);  // On suppose que l'ID de l'utilisateur est stocké dans la session

} elseif ($_SERVER['REQUEST_URI'] === '/quiz/setup' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    require dirname(__DIR__) . '/app/views/quiz/setup.php';
} elseif (strpos($_SERVER['REQUEST_URI'], '/quiz/play') === 0 && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $quizController->startQuiz();
} elseif ($_SERVER['REQUEST_URI'] === '/quiz/answer' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $quizController->answerQuestion();
} elseif ($_SERVER['REQUEST_URI'] === '/quiz/result') {
    require dirname(__DIR__) . '/app/views/quiz/result.php';
} elseif ($_SERVER['REQUEST_URI'] === '/quiz/save' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $quizController->saveQuiz();
} elseif ($_SERVER['REQUEST_URI'] === '/quiz/next' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $quizController->nextQuestion();
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
