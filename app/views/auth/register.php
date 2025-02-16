<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>

    <?php
    session_start();
    if (!empty($_SESSION['message'])) : ?>
        <p style="color: red;"><?= htmlspecialchars($_SESSION['message']) ?></p>
        <?php unset($_SESSION['message']); // Supprimer le message après affichage ?>
    <?php endif; ?>

    <form action="/auth/register" method="POST">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">S'inscrire</button>
    </form>

    <p>Déjà inscrit ? <a href="/auth/login">Connecte-toi ici</a></p>

</body>
</html>
