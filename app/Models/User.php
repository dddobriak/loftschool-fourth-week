<?php

namespace App\Models;

use App\Traits\DB;
use PDO;
use PDOException;

class User
{
    use DB;

    private $user;

    public function __construct($user)
    {
        $this->user['name'] = $user['name'];
        $this->user['email'] = $user['email'];
        $this->user['password'] = $user['password'];
    }

    /**
     * Create new user
     *
     * @return void
     * @throws PDOException
     */
    public function create(): void
    {
        $prepare = self::db()->dbh()
            ->prepare("
                insert into users (`name`, `email`, `password`)
                values (:name, :email, :password)
            ");

        $prepare->execute($this->user);
        $insertId = self::db()->dbh()->lastInsertId();
        $userData = implode(' ', self::getById($insertId));

        setMessage("user: {$userData} created");
    }

    /**
     * Get user by user id
     *
     * @param int $id
     * @return array|false
     * @throws PDOException
     */
    public static function getById($id): array|false
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
     * @return array|false
     * @throws PDOException
     */
    public static function getByEmail($email): array|false
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
    public static function delete($id): void
    {
        $userData = self::getById($id) ? $id : 'not found';

        $prepare = self::db()->dbh()
            ->prepare("delete from users where id = ?");
        $prepare->execute([$id]);

        setMessage("user {$userData} deleted");
    }

    /**
     * Select user by user email and user password
     *
     * @return array|false
     * @throws PDOException
     */
    public static function canLogin($user): array|false
    {
        $prepare = self::db()->dbh()
            ->prepare("select * from users where email = :email and password = :password");
        $prepare->execute($user);

        return $prepare->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Check if user has admin role
     *
     * @return int|null
     * @throws PDOException
     */
    public static function isAdmin(): int|null
    {
        $prepare = self::db()->dbh()
            ->prepare("select * from users where email = ? and is_admin = 1");
        $prepare->execute([$_SESSION['email']]);

        return $prepare->fetch(PDO::FETCH_ASSOC)['is_admin'];
    }
}
