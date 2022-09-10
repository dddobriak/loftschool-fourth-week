<?php

namespace App\Models;

use PDO;
use PDOException;

class User
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

    /**
     * Create new user
     *
     * @param array $user
     * @return void
     * @throws PDOException
     */
    public static function create($user)
    {
        $prepare = self::db()->dbh()
            ->prepare("
                insert into users (`name`, `email`, `password`)
                values (:name, :email, :password)
            ");

        $prepare->execute($user);
        $insertId = self::db()->dbh()->lastInsertId();
        $userData = implode(' ', self::getById($insertId));

        return setMessage("user: {$userData} created");
    }

    /**
     * Get user by user id
     *
     * @param int $id
     * @return mixed
     * @throws PDOException
     */
    public static function getById($id)
    {
        $prepare = self::db()->dbh()
            ->prepare("select * from users where id = ?");
        $prepare->execute([$id]);

        return $prepare->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get user by user email
     *
     * @param string $email
     * @return mixed
     * @throws PDOException
     */
    public static function getByEmail($email)
    {
        $prepare = self::db()->dbh()
            ->prepare("select * from users where email = ?");
        $prepare->execute([$email]);

        return $prepare->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Delet user by user id
     *
     * @param int $id
     * @return void
     * @throws PDOException
     */
    public static function delete($id)
    {
        $userData = self::getById($id) ? $id : 'not found';

        $prepare = self::db()->dbh()
            ->prepare("delete from users where id = ?");
        $prepare->execute([$id]);

        return setMessage("user {$userData} deleted");
    }

    /**
     * Select user by user email and user password
     *
     * @param array $user
     * @return mixed
     * @throws PDOException
     */
    public static function canLogin($user)
    {
        $prepare = self::db()->dbh()
            ->prepare("select * from users where email = :email and password = :password");
        $prepare->execute($user);

        return $prepare->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Check if user has admin role
     *
     * @return mixed
     * @throws PDOException
     */
    public static function isAdmin()
    {
        $prepare = self::db()->dbh()
            ->prepare("select * from users where email = ? and is_admin = 1");
        $prepare->execute([$_SESSION['email']]);

        return $prepare->fetch(PDO::FETCH_ASSOC)['is_admin'];
    }
}
