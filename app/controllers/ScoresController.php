<?php
// app/Controllers/ScoresController.php

namespace App\Controllers;

use App\Models\ParticipationModel;

class ScoresController
{
    // Méthode pour afficher les scores de l'utilisateur
    public function showScores($userId)
    {
        // Créer une instance du modèle ParticipationModel
        $participationModel = new ParticipationModel();

        // Récupérer les participations de l'utilisateur
        $scores = $participationModel->getParticipationsByUserId($userId);

        // Rendre la vue 'scores' en lui passant les scores
        $this->render('scores/scores', ['scores' => $scores]);
    }

    // Fonction render pour charger la vue
    private function render($view, $data = [])
    {
        extract($data); // Extraire les variables depuis le tableau $data
        require dirname(__DIR__, 2) . "/app/Views/$view.php"; // Charger la vue
    }
}

