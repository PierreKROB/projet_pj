<?php

require 'vendor/autoload.php';

use MongoDB\Client;

class Database
{
    private static $client;

    public static function getConnection()
    {
        if (!self::$client) {
            self::$client = new Client("mongodb+srv://admin:DLdCQ9iVeqe1s4XB@cluster0.zkmz0.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0");
        }
        return self::$client;
    }
}
