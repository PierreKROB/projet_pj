<?php
session_start();

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use MongoDB\Client;

// Charger les variables d'environnement
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Connexion à MongoDB
$mongoClient = new Client($_ENV['MONGO_URI']);
$database = $mongoClient->selectDatabase("quiz_db"); // Remplace par le nom de ta base MongoDB
$collection = $database->selectCollection("scores");

// Récupération des scores de l'utilisateur
$scoresCursor = $collection->find(["user_id" => $user_id], ["sort" => ["date" => -1]]);
$scores = iterator_to_array($scoresCursor);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Scores</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        p {
            margin-top: 15px;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Vos Scores de Quiz</h1>
        
        <?php if (count($scores) > 0): ?>
            <table>
                <tr>
                    <th>ID du Quiz</th>
                    <th>Titre</th>
                    <th>Score</th>
                    <th>Date</th>
                </tr>
                <?php foreach ($scores as $score): ?>
                    <tr>
                        <td><?= htmlspecialchars($score['quiz_id']) ?></td>
                        <td><?= htmlspecialchars($score['titre'] ?? 'Inconnu') ?></td>
                        <td><?= htmlspecialchars($score['score']) ?></td>
                        <td><?= htmlspecialchars($score['date']->toDateTime()->format('Y-m-d H:i:s')) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Aucun score enregistré pour le moment.</p>
        <?php endif; ?>
        
        <p><a href="index.php">Retour à l'accueil</a></p>
    </div>
</body>
</html>