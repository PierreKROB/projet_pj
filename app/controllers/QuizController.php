<?php
namespace App\Controllers;

class QuizController
{
    public function fetchQuiz($amount, $type)
    {
        if ($type === "both") {
            $typeParam = "";
        } else {
            $typeParam = "&type=" . $type;
        }

        $url = "https://opentdb.com/api.php?amount={$amount}{$typeParam}";

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

    // Vérifier et initialiser le quiz
    if (!isset($_SESSION['quiz']) || empty($_SESSION['quiz'])) {
        $amount = $_GET['amount'] ?? 10;
        $type = $_GET['type'] ?? "both";
        $_SESSION['quiz'] = $this->fetchQuiz($amount, $type);
        $_SESSION['current_question'] = 0; // Début du quiz
        $_SESSION['score'] = 0; // Score initialisé
    }

    // Vérifier si `current_question` existe
    if (!isset($_SESSION['current_question']) || !is_numeric($_SESSION['current_question'])) {
        $_SESSION['current_question'] = 0;
    }

    $questionIndex = $_SESSION['current_question'];
    $quiz = $_SESSION['quiz'];

    // Vérifier que la question existe bien avant d'afficher
    if (!isset($quiz[$questionIndex])) {
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

    $_SESSION['current_question']++;

    header("Location: /quiz/play");
    exit();
}


    private function render($view, $data = [])
    {
        extract($data);
        require dirname(__DIR__, 2) . "/app/views/$view.php";
    }
}
