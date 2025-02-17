<?php 
session_start();
include __DIR__ . '/../layouts/header.php'; 

$score = $_SESSION['score'] ?? 0;
$totalQuestions = isset($_SESSION['quiz']) ? count($_SESSION['quiz']) : 0;

unset($_SESSION['quiz']);
unset($_SESSION['current_question']);
unset($_SESSION['score']);
?>

<main>
    <h2>Quiz terminé !</h2>

    <p>Votre score final : <?= $score ?> / <?= $totalQuestions ?></p>

    <hr>

    <h3>Ce quiz vous a plu ?</h3>
    <p>Vous pouvez l'enregistrer pour le retrouver plus tard.</p>

    <form action="/quiz/save" method="POST">
        <label for="title">Titre du quiz :</label>
        <input type="text" name="title" id="title" required>

        <button type="submit">💾 Enregistrer le quiz</button>
    </form>

    <br>

    <a href="/">🏠 Retour à l'accueil</a>
</main>

</body>
</html>
