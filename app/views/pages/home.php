<?php include __DIR__ . '/../layouts/header.php'; ?>

<main>
    <h2>Bienvenue sur Battle Quizz</h2>
    <p>Bonjour, <?= htmlspecialchars($_SESSION['user']['username']) ?> !</p>
    <p>Prêt à tester vos connaissances ?</p>
</main>
</body>
</html>
