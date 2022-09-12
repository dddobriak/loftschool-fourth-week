<?php

namespace App\Models;

use Exception;
use PDO;

class DbConnect
{
    private static $instance = null;
    private $db;

    private function __construct()
    {
        $config = require_once ROOT . '/config/database.php';

        try {
            $this->db = new \PDO(
                "mysql:host={$config['host']};dbname={$config['dbname']}",
                $config['user'],
                $config['password']
            );
        } catch (\Exception $e) {
            die($e);
        }
    }

    public function dbh()
    {
        return $this->db;
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}
