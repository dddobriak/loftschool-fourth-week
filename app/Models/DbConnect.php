<?php

namespace App\Models;

use Exception;
use PDO;

class DbConnect
{
    private static $instance = null;
    private $dbh;

    private function __construct()
    {
        $db = require_once ROOT . '/config/database.php';

        try {
            $this->dbh = new PDO("mysql:host={$db['host']};dbname={$db['dbname']}", $db['user'], $db['password']);
        } catch (Exception $e) {
            die($e);
        }
    }

    public function dbh()
    {
        return $this->dbh;
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}
