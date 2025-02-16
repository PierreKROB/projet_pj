<?php

namespace App\Controllers;

class PageController
{
    public function showHomePage()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header('Location: /auth/login');
            exit();
        }

        $this->render('pages/home');
    }


    private function render($view, $data = [])
    {
        extract($data);
        require __DIR__ . "/../../views/$view.php";
    }
}
