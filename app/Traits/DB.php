<?php

namespace App\Traits;

use App\Models\DbConnect;

trait DB
{
    /**
     * Init db instance
     *
     * @return DbConnect
     */
    public static function db()
    {
        return DbConnect::getInstance();
    }
}
