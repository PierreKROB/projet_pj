<?php
namespace App\Models;

require_once __DIR__ . '/../../vendor/autoload.php';

use MongoDB\Client;
use Dotenv\Dotenv;

class BaseModel
{
    protected static $db;

    public function __construct()
    {
        if (!self::$db) {
            $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
            $dotenv->load();

            $mongoUri = $_ENV['MONGO_URI'] ?? 'mongodb://localhost:27017';

            $client = new Client($mongoUri);
            self::$db = $client->selectDatabase('Cluster0');
        }
    }

    protected function getCollection($collectionName)
    {
        return self::$db->{$collectionName};
    }
}
