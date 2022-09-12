<?php

namespace App\Models;

use App\Traits\DB;
use PDO;
use PDOException;

class Post
{
    use DB;

    private $post;

    public function __construct($post)
    {
        $this->post['title'] = $post['title'];
        $this->post['text'] = $post['text'];
        $this->post['user_id'] = Auth::check($_SESSION)['id'];
    }

    /**
     * Create post
     *
     * @param array $post
     * @return void
     * @throws PDOException
     */
    public function create(): void
    {
        $prepare = self::db()->dbh()
            ->prepare("
                insert into posts (`title`, `text`, `user_id`)
                values (:title, :text, :user_id)
            ");

        $prepare->execute($this->post);
        $insertId = self::db()->dbh()->lastInsertId();

        setMessage("post: {$insertId} created");
    }

    /**
     * Read all posts
     *
     * @return array|false
     */
    public static function read(): array|false
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
    public static function delete($id): void
    {
        $postData = self::getById($id) ? $id : 'not found';
        $prepare = self::db()->dbh()
            ->prepare("delete from posts where id = ?");
        $prepare->execute([$id]);

        setMessage("post {$postData} deleted");
    }

    /**
     * Get post by post id
     *
     * @param mixed $id
     * @return array|false
     * @throws PDOException
     */
    public static function getById($id): array|false
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
    public static function getByUser($id): array|false
    {
        $prepare = self::db()->dbh()
            ->prepare("select * from posts where user_id = ?");
        $prepare->execute([$id]);

        return $prepare->fetchAll(PDO::FETCH_ASSOC);
    }
}
