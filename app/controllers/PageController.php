<?php

namespace App\Controllers;

class PageController
{
    public function showHomePage()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: /auth/login');
            exit();
        }
        $this->render('pages/homepage');
    }

    private function render($view, $data = [])
    {
        extract($data);
        require __DIR__ . "/../../views/$view.php";
    }
}
