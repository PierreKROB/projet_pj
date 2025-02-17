<?php
namespace App\Controllers;

use App\Models\ParticipationModel;
use App\Models\UserModel;

class ScoresController
{
    public function showScores($userId)
    {
        $participationModel = new ParticipationModel();
        $userModel = new UserModel();

        $scores = $participationModel->getParticipationsByUserId($userId);
        $user = $userModel->getUserById($userId);

        // Récupérer le nombre de quiz joués
        $quizzesPlayed = $user['quizzes_played'] ?? 0;

        $this->render('scores/scores', [
            'scores' => $scores,
            'quizzesPlayed' => $quizzesPlayed
        ]);
    }

    private function render($view, $data = [])
    {
        extract($data);
        require dirname(__DIR__, 2) . "/app/Views/$view.php";
    }
}
