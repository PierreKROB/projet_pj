<?php include __DIR__ . '/../layouts/header.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejouer un Quiz</title>
    <style>
        main {
            padding: 10px 20px;
        }
        h2 {
            color: #333;
        }
        input[type="radio"] {
            margin-right: 10px;
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
        .score {
            font-size: 1.2rem;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<main>
    <h2>Question <?= isset($index) ? $index + 1 : 1 ?></h2>

    <?php if (!empty($_SESSION['message'])) : ?>
        <p><?= $_SESSION['message'] ?></p>
    <?php endif; ?>

    <?php if (isset($_SESSION['awaiting_next']) && $_SESSION['awaiting_next'] === true) : ?>
        <form action="/quiz/replay-next" method="POST">
            <button type="submit">➡ Suivant</button>
        </form>
        <?php unset($_SESSION['awaiting_next']); ?>
    <?php else : ?>
        <?php if (isset($question) && !empty($question)) : ?>
            <p><?= isset($question['question']) ? html_entity_decode($question['question']) : "Question indisponible" ?></p>

            <form action="/quiz/answer" method="POST">
                <input type="hidden" name="question_index" value="<?= $index ?>">
                
                <?php
                if (isset($question['incorrect_answers']) && isset($question['correct_answer'])) {
                    $answers = (array) $question['incorrect_answers'];
                    $answers[] = $question['correct_answer'];
                    shuffle($answers);
                } else {
                    $answers = [];
                }
                ?>

                <?php if (!empty($answers)) : ?>
                    <?php foreach ($answers as $answer) : ?>
                        <label>
                            <input type="radio" name="answer" value="<?= htmlspecialchars($answer) ?>" required>
                            <?= htmlspecialchars($answer) ?>
                        </label><br>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>Réponses indisponibles.</p>
                <?php endif; ?>

                <button type="submit">Valider</button>
            </form>
        <?php else : ?>
            <p>Erreur : Question introuvable.</p>
        <?php endif; ?>
    <?php endif; ?>

    <br>
    <p>Score actuel : <?= $_SESSION['score'] ?? 0 ?></p>
</main>

</body>
</html>
