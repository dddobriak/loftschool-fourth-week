<?php

namespace App\Controllers;

use App\Models\User;
use PDOException;

class UserController
{
    /**
     * Create new user
     *
     * @return void
     * @throws PDOException
     */
    public function create()
    {
        User::create($_POST);

        return view('index');
    }

    /**
     * Delete user
     *
     * @return void
     * @throws PDOException
     */
    public function delete()
    {
        $userId = $_GET['user_id'];
        User::delete($userId);

        return view('index');
    }
}
