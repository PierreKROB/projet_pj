<?php include __DIR__ . '/../layouts/header.php'; ?>

<main>
    <h2>Créer un Quiz</h2>

    <form action="/quiz/play" method="GET">
        <!-- Nombre de questions (max 10) -->
        <label for="amount">Nombre de questions :</label>
        <input type="number" name="amount" id="amount" value="10" min="1" max="10" required>

        <br>

        <!-- Type de questions : Multiple, True/False ou les deux -->
        <label for="type">Type de questions :</label>
        <select name="type" id="type">
            <option value="both" selected>Les deux</option>
            <option value="multiple">Choix multiples</option>
            <option value="boolean">Vrai ou Faux</option>
        </select>

        <br>

        <button type="submit">🎮 Lancer le Quiz</button>
    </form>

    <br>

    <a href="/">⬅ Retour à l'accueil</a>
</main>

</body>
</html>
