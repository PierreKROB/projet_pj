<?php 
session_start();
include __DIR__ . '/../layouts/header.php'; 

$score = $_SESSION['score'] ?? 0;
$totalQuestions = isset($_SESSION['quiz']) ? count($_SESSION['quiz']) : 0;

$quizCopy = $_SESSION['quiz'] ?? [];

unset($_SESSION['quiz']);
unset($_SESSION['current_question']);
unset($_SESSION['score']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <style>
        main{
            padding: 10px 20px;
        }
        h2 {
            color: #333;
        }
        .good {
            color: #4CAF50;
        }

        .average {
            color: #f39c12;
        }

        .bad {
            color: #e74c3c;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 200px;
            font-size: 16px;
        }

        button:hover {
            background-color: rgb(62, 142, 65);
        }
    </style>
<main>
    <h2>Quiz terminé !</h2>

    <p>Votre score final : <?= $score ?> / <?= $totalQuestions ?></p>
    <?php
        if ($score == $totalQuestions) {
            echo '<p class="message good">🔥 Parfait ! Vous êtes un maître du quiz !</p>';
        } elseif ($score >= ($totalQuestions / 2)) {
            echo '<p class="message average">💡 Ca va, c est bien ! Vous avez un bon niveau.</p>';
        } else {
            echo '<p class="message bad">😕 Vraiment nul, révises !</p>';
        }
        ?>

    <hr>

    <h3>Ce quiz vous a plu ?</h3>
    <p>Vous pouvez l'enregistrer pour le retrouver plus tard.</p>

    <form action="/quiz/save" method="POST">
        <label for="title">Titre du quiz :</label>
        <input type="text" name="title" id="title" required>
        <input type="hidden" name="quiz_data" value="<?= htmlspecialchars(json_encode($quizCopy)) ?>">

        <button type="submit">💾 Enregistrer le quiz</button>
    </form>

    <br>

    <a href="/">🏠 Retour à l'accueil</a>
</main>

</body>
</html>
