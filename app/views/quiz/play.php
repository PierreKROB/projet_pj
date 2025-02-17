<?php include __DIR__ . '/../layouts/header.php'; ?>

<main>
    <h2>Question <?= isset($index) ? $index + 1 : 1 ?></h2>

    <?php if (!empty($_SESSION['message'])) : ?>
        <p><?= htmlspecialchars($_SESSION['message']) ?></p>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <?php if (isset($question) && !empty($question)) : ?>
        <p><?= isset($question['question']) ? htmlspecialchars($question['question']) : "Question indisponible" ?></p>

        <form action="/quiz/answer" method="POST">
            <input type="hidden" name="question_index" value="<?= $index ?>">

            <?php
            if (isset($question['incorrect_answers']) && isset($question['correct_answer'])) {
                $answers = $question['incorrect_answers'];
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

    <br>
    <p>Score actuel : <?= $_SESSION['score'] ?? 0 ?></p>
</main>

</body>
</html>
