<?php

namespace App\Models;

use PDO;
use PDOException;

class Post
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
     * Create post
     *
     * @param array $post
     * @return void
     * @throws PDOException
     */
    public static function create($post)
    {
        $prepare = self::db()->dbh()
            ->prepare("
                insert into posts (`title`, `text`, `user_id`)
                values (:title, :text, :user_id)
            ");

        $post['user_id'] = Auth::check($_SESSION)['id'];
        $prepare->execute($post);
        $insertId = self::db()->dbh()->lastInsertId();

        return setMessage("post: {$insertId} created");
    }

    /**
     * Read all posts
     *
     * @return array|false
     */
    public static function read()
    {
        $query = self::db()->dbh()
            ->query("select * from posts");

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Delete psot
     *
     * @param int $id
     * @return void
     * @throws PDOException
     */
    public static function delete($id)
    {
        $postData = self::getById($id) ? $id : 'not found';
        $prepare = self::db()->dbh()
            ->prepare("delete from posts where id = ?");
        $prepare->execute([$id]);

        return setMessage("post {$postData} deleted");
    }

    /**
     * Get post by post id
     *
     * @param mixed $id
     * @return array|false
     * @throws PDOException
     */
    public static function getById($id)
    {
        $prepare = self::db()->dbh()
            ->prepare("select * from posts where id = ?");
        $prepare->execute([$id]);

        return $prepare->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get post by user id
     *
     * @param mixed $id
     * @return array|false
     * @throws PDOException
     */
    public static function getByUser($id)
    {
        $prepare = self::db()->dbh()
            ->prepare("select * from posts where user_id = ?");
        $prepare->execute([$id]);

        return $prepare->fetchAll(PDO::FETCH_ASSOC);
    }
}
