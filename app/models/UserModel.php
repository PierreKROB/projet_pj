<?php

namespace App\Models;

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class UserModel extends BaseModel
{
    private $collection;

    public function __construct()
    {
        parent::__construct();
        $this->collection = $this->getCollection('users');
    }

    public function register($username, $password)
    {
        $validation = $this->validateUserData($username, $password);
        if (!$validation['success']) {
            return $validation;
        }

        $existingUser = $this->collection->findOne(['username' => $username]);
        if ($existingUser) {
            return ['success' => false, 'message' => 'Nom d\'utilisateur déjà pris.'];
        }

        $this->collection->insertOne([
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'created_at' => new UTCDateTime(),
        ]);

        return ['success' => true, 'message' => 'Utilisateur enregistré avec succès.'];
    }

    public function login($username, $password)
    {
        $validation = $this->validateUserData($username, $password);
        if (!$validation['success']) {
            return $validation;
        }

        $user = $this->collection->findOne(['username' => $username]);
        if (!$user) {
            return ['success' => false, 'message' => 'Utilisateur introuvable.'];
        }

        if (!password_verify($password, $user['password'])) {
            return ['success' => false, 'message' => 'Mot de passe incorrect.'];
        }

        return ['success' => true, 'user' => $user];
    }

    private function validateUserData($username, $password)
    {
        if (empty($username) || empty($password)) {
            return ['success' => false, 'message' => 'Tous les champs sont requis.'];
        }

        if (strlen($username) < 3 || strlen($username) > 20) {
            return ['success' => false, 'message' => 'Le nom d\'utilisateur doit contenir entre 3 et 20 caractères.'];
        }

        if (strlen($password) < 8) {
            return ['success' => false, 'message' => 'Le mot de passe doit contenir au moins 8 caractères.'];
        }

        return ['success' => true];
    }

    public function incrementQuizzesPlayed($userId)
    {
        $this->collection->updateOne(
            ['_id' => new ObjectId($userId)],
            ['$inc' => ['quizzes_played' => 1]]
        );
    }

    public function getUserById($userId)
    {
        return $this->collection->findOne(['_id' => new ObjectId($userId)]);
    }
}
