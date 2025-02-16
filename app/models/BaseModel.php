<?php

namespace App\Models;
require_once __DIR__ . '/../../vendor/autoload.php';
use MongoDB\Client;

class BaseModel
{
    protected static $db;

    public function __construct()
    {
        if (!self::$db) {
            $client = new Client("mongodb://localhost:27017");
            self::$db = $client->selectDatabase('quiz_battle');
        }
    }

    protected function getCollection($collectionName)
    {
        return self::$db->{$collectionName};
    }
}
