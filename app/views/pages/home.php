<?php include __DIR__ . '/../layouts/header.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Battle Quizz</title>
    <style>
        main{
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
        }

        button:hover {
            background-color: rgb(62, 142, 65);
        }
    </style>
</head>
<main>
    <h2>Bienvenue sur Battle Quizz</h2>

    <p>Prêt à tester tes connaissances ?</p>

    <a href="/quiz/setup">
        <button>🎲 Générer un Quiz</button>
    </a>

</main>

</body>
</html>
