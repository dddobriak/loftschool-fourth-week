<?php

namespace App\Models;

class Migrate
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

    public static function createUsersTable()
    {
        self::db()->dbh()
            ->query(
                "CREATE TABLE IF NOT EXISTS `users` (
                `id` bigint(20) NOT NULL AUTO_INCREMENT,
                `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `is_admin` tinyint DEFAULT NULL,
                PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"
            );

        return setMessage('users table created');
    }

    public static function createPostsTable()
    {
        self::db()->dbh()
            ->query(
                "CREATE TABLE IF NOT EXISTS `posts` (
                `id` bigint(20) NOT NULL AUTO_INCREMENT,
                `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `text` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `user_id` bigint(20) DEFAULT NULL,
                PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"
            );

        return setMessage('posts table created');
    }

    public static function dropUsersTable()
    {
        self::db()->dbh()
            ->query("DROP TABLE IF EXISTS `users`");

        return setMessage('users table removed');
    }

    public static function dropPostsTable()
    {
        self::db()->dbh()
            ->query("DROP TABLE IF EXISTS `posts`");

        return setMessage('posts table removed');
    }
}
