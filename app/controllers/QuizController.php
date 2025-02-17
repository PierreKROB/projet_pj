<?php

namespace App\Controllers;

use App\Models\QuizModel;

class QuizController
{
    public function fetchQuiz($amount, $type, $difficulty, $category)
    {
        $typeParam = ($type === "both") ? "" : "&type=" . $type;
        $difficultyParam = "&difficulty=" . $difficulty;
        $categoryParam = ($category !== "any") ? "&category=" . $category : "";

        $url = "https://opentdb.com/api.php?amount={$amount}{$typeParam}{$difficultyParam}{$categoryParam}";

        $response = file_get_contents($url);
        $quizData = json_decode($response, true);

        if ($quizData['response_code'] !== 0) {
            die("Erreur lors de la récupération du quiz.");
        }

        return $quizData['results'];
    }

    public function startQuiz()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: /auth/login');
            exit();
        }

        if (!isset($_SESSION['quiz']) || empty($_SESSION['quiz'])) {
            $amount = $_GET['amount'] ?? 10;
            $type = $_GET['type'] ?? "both";
            $difficulty = $_GET['difficulty'] ?? "medium";
            $category = $_GET['category'] ?? "any";

            $_SESSION['quiz'] = $this->fetchQuiz($amount, $type, $difficulty, $category);
            $_SESSION['current_question'] = 0;
            $_SESSION['score'] = 0;
        }

        $questionIndex = $_SESSION['current_question'];
        $quiz = $_SESSION['quiz'];

        if ($questionIndex >= count($quiz)) {
            $userModel = new \App\Models\UserModel();
            $userModel->incrementQuizzesPlayed($_SESSION['user']['id']);
    
            header("Location: /quiz/result");
            exit();
        }

        $currentQuestion = $quiz[$questionIndex];

        $this->render('quiz/play', ['question' => $currentQuestion, 'index' => $questionIndex]);
    }

    public function answerQuestion()
    {
        session_start();
        if (!isset($_SESSION['user']) || !isset($_SESSION['quiz'])) {
            header('Location: /auth/login');
            exit();
        }

        $questionIndex = $_POST['question_index'];
        $userAnswer = $_POST['answer'];
        $quiz = $_SESSION['quiz'];

        if (!isset($quiz[$questionIndex])) {
            header("Location: /quiz/play");
            exit();
        }

        $correctAnswer = $quiz[$questionIndex]['correct_answer'];

        if ($userAnswer === $correctAnswer) {
            $_SESSION['score'] += 1;
            $_SESSION['message'] = "✅ Bonne réponse !";
        } else {
            $_SESSION['message'] = "❌ Mauvaise réponse ! La bonne réponse était : <strong>$correctAnswer</strong>";
        }

        $_SESSION['awaiting_next'] = true;

        header("Location: /quiz/play");
        exit();
    }


    public function saveQuiz()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: /auth/login');
            exit();
        }

        if (empty($_POST['title']) || empty($_POST['quiz_data'])) {
            $_SESSION['message'] = "❌ Veuillez entrer un titre et ne pas quitter la page avant d'enregistrer.";
            header("Location: /quiz/result");
            exit();
        }

        $userId = $_SESSION['user']['id'];
        $title = $_POST['title'];
        $questions = json_decode($_POST['quiz_data'], true);

        if (!$questions) {
            $_SESSION['message'] = "❌ Erreur lors de la récupération des questions.";
            header("Location: /quiz/result");
            exit();
        }

        $difficulty = $questions[0]['difficulty'] ?? 'medium';
        $category = $questions[0]['category'] ?? 'any';

        $quizModel = new \App\Models\QuizModel();
        $quizModel->createQuiz($userId, $title, $difficulty, $category, $questions);

        $_SESSION['message'] = "";
        header("Location: /");
        exit();
    }

    public function nextQuestion()
{
    session_start();
    if (!isset($_SESSION['user']) || !isset($_SESSION['quiz'])) {
        header('Location: /auth/login');
        exit();
    }

    $_SESSION['current_question']++;

    unset($_SESSION['message']);

    header("Location: /quiz/play");
    exit();
}



    private function render($view, $data = [])
    {
        extract($data);
        require dirname(__DIR__, 2) . "/app/views/$view.php";
    }
}
