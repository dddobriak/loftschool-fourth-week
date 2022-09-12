<?php

namespace App\Models;

use PDOException;

class Auth
{
    /**
     * Check if user exists by email
     *
     * @param array $user
     * @return mixed
     * @throws PDOException
     */
    public static function check($user): mixed
    {
        return User::getByEmail($user['email']) ?? false;
    }

    /**
     * Set user session
     *
     * @param mixed $user
     * @return true|void
     * @throws PDOException
     */
    public static function loginUser($user): bool
    {
        $user['password'] = sha1($user['password']);

        if (User::canLogin($user)) {
            setAuthSession($user['email']);

            return true;
        }
    }

    /**
     * Create new user
     *
     * @param array $user
     * @return mixed
     * @throws PDOException
     */
    public static function createUser($user): mixed
    {
        if ($user['name'] && $user['email'] && $user['password']) {
            $user['password'] = sha1($user['password']);
            (new User($user))->create();
            setAuthSession($user['email']);

            return true;
        }
    }

    public static function logoutUser()
    {
        // to do
        return setMessage('You are logged out');
    }
}
