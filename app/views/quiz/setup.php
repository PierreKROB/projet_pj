<?php include __DIR__ . '/../layouts/header.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup</title>
    <style>
        main{
            padding: 10px 20px;
        }
        h2 {
            color: #333;
        }

        label {
            display: block;
            text-align: left;
            font-weight: 600;
            margin: 10px 0 5px;
        }

        input, select {
            width: 40%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
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

        <!-- Niveau de difficulté -->
        <label for="difficulty">Difficulté :</label>
        <select name="difficulty" id="difficulty">
            <option value="easy">Facile</option>
            <option value="medium" selected>Moyen</option>
            <option value="hard">Difficile</option>
        </select>

        <br>

        <!-- Catégorie -->
        <label for="category">Catégorie :</label>
        <select name="category" id="category">
            <option value="any" selected>Toutes les catégories</option>
            <option value="9">Culture Générale</option>
            <option value="10">Divertissement : Livres</option>
            <option value="11">Divertissement : Films</option>
            <option value="12">Divertissement : Musique</option>
            <option value="13">Divertissement : Théâtre</option>
            <option value="14">Divertissement : Télévision</option>
            <option value="15">Jeux Vidéo</option>
            <option value="17">Science & Nature</option>
            <option value="18">Informatique</option>
            <option value="19">Mathématiques</option>
            <option value="21">Sports</option>
            <option value="23">Histoire</option>
            <option value="24">Politique</option>
            <option value="27">Animaux</option>
            <option value="28">Véhicules</option>
        </select>

        <br>

        <button type="submit">🎮 Lancer le Quiz</button>
    </form>

    <br>

    <a href="/">🏠 Retour à l'accueil</a>
</main>

</body>
</html>
