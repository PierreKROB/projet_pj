<?php 
include __DIR__ . '/../layouts/header.php';  

$quizInProgress = isset($_SESSION['quiz']) && !empty($_SESSION['quiz']);

if (!$quizInProgress || isset($_POST['reset_quiz'])) {
    unset($_SESSION['quiz']);
    unset($_SESSION['current_question']);
    unset($_SESSION['score']);
    $quizInProgress = false;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Battle Quizz</title>
    <style>
        main {
            padding: 10px 20px;
        }
        h2 {
            color: #333;
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
            margin: 5px;
        }
        button:hover {
            background-color: rgb(62, 142, 65);
        }
        .warning-box {
            border: 2px solid #f39c12;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #fff3cd;
        }
        .danger-button {
            background-color: #e74c3c;
        }
        .danger-button:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>

<main>
    <h2>Bienvenue sur Battle Quizz</h2>

    <p>Prêt à tester tes connaissances ?</p>

    <?php if ($quizInProgress) : ?>
        <div class="warning-box">
            <h3>⚠️ Un quiz est en cours</h3>
            <p>Voulez-vous reprendre votre quiz ou en commencer un nouveau ?</p>
            
            <form action="/quiz/play" method="POST" style="display: inline;">
                <button type="submit">▶ Reprendre le Quiz</button>
            </form>

            <form action="/" method="POST" style="display: inline;">
                <input type="hidden" name="reset_quiz" value="1">
                <button type="submit" class="danger-button">❌ Nouveau Quiz</button>
            </form>
        </div>
    <?php endif; ?>

    <a href="/quiz/setup">
        <button>🎲 Générer un Quiz</button>
    </a>

</main>

</body>
</html>
