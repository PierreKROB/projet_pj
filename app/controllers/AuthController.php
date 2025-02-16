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
        return $this->userModel->register($username, $password);
    }

    public function login($username, $password)
    {
        $result = $this->userModel->login($username, $password);

        if ($result['success']) {
            session_start();
            $_SESSION['user'] = [
                'id' => (string) $result['user']['_id'],
                'username' => $result['user']['username'],
            ];
        }

        return $result;
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
