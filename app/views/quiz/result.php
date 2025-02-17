<?php 
session_start();
include __DIR__ . '/../layouts/header.php'; 

$score = $_SESSION['score'] ?? 0;
$totalQuestions = isset($_SESSION['quiz']) ? count($_SESSION['quiz']) : 0;

unset($_SESSION['quiz']);
unset($_SESSION['current_question']);
?>

<main>
    <h2>Quiz terminé !</h2>

    <p>Votre score final : <?= $score ?> / <?= $totalQuestions ?></p>

    <a href="/">🏠 Retour à l'accueil</a>
</main>

</body>
</html>
