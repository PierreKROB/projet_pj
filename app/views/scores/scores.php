<?php include __DIR__ . '/../layouts/header.php';  ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Scores</title>
    <style>
        div {
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

<body>
    <div class="container">
        <h1>Vos Scores de Quiz</h1>

        <h2>Nombre total de quiz joués : <?= $quizzesPlayed ?></h2>

        <?php if (count($scores) > 0): ?>
            <table>
                <tr>
                    <th>ID Quiz</th>
                    <th>Score</th>
                    <th>Date</th>
                </tr>
                <?php foreach ($scores as $score): ?>
                    <tr>
                        <td><?= htmlspecialchars($score['quiz_id']) ?></td>
                        <td><?= htmlspecialchars($score['score']) ?></td>
                        <td><?= htmlspecialchars($score['played_at']->toDateTime()->format('Y-m-d H:i:s')) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Aucun score enregistré pour le moment.</p>
        <?php endif; ?>

        <p><a href="/">🏠 Retour à l'accueil</a></p>
    </div>
</body>

</html>