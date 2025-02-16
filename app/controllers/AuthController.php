<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function register($username, $password)
    {
        session_start();

        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            $_SESSION['message'] = "Veuillez remplir tous les champs.";
            header("Location: /auth/register");
            exit;
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = $this->userModel->register($username, $password);

        if ($result['success']) {
            $_SESSION['message'] = "Inscription réussie. Vous pouvez maintenant vous connecter.";
            header("Location: /auth/login");
            exit;
        } else {
            $_SESSION['message'] = $result['message'];
            header("Location: /auth/register");
            exit;
        };
    }

    public function login()
    {
        session_start();

        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            $_SESSION['message'] = "Veuillez remplir tous les champs.";
            header("Location: /auth/login");
            exit;
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = $this->userModel->login($username, $password);

        if ($result['success']) {
            $_SESSION['user'] = [
                'id' => (string) $result['user']['_id'],
                'username' => $result['user']['username'],
            ];
            header("Location: /");
            exit;
        } else {
            $_SESSION['message'] = $result['message'];
            header("Location: /auth/login");
            exit;
        }
    }



    public function logout()
    {
        session_start();
        session_destroy();
        return ['success' => true, 'message' => 'Déconnecté avec succès.'];
    }

    public function render($view, $data = [])
    {
        extract($data);
        require dirname(__DIR__, 2) . "/app/views/$view.php";
    }



    public function showRegisterForm()
    {
        $this->render('auth/register');
    }

    public function showLoginForm()
    {
        $this->render('auth/login');
    }
}
