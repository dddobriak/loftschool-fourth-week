<?php

namespace App\Controllers;

use App\Models\Auth;
use App\Models\Post;
use App\Models\User;
use PDOException;

class BlogController
{
    /**
     * Create blog view if user authenticated
     *
     * @return void
     * @throws PDOException
     */
    public function create()
    {
        if (!Auth::check($_SESSION)) {
            return header('Location: /auth');
        }

        $posts = Post::read();
        $isAdmin = User::isAdmin();

        return view('index', compact('posts', 'isAdmin'));
    }

    /**
     * Add new post
     *
     * @return void
     * @throws PDOException
     */
    public function addPost()
    {
        if (!Auth::check($_SESSION)) {
            return header('Location: /auth');
        }

        if (!($_POST['title'] && $_POST['text'])) {
            setMessage('Some fields are empty');

            return header('Location: /');
        }

        (new Post($_POST))->create();

        return header('Location: /');
    }

    /**
     * Delete post
     *
     * @return void
     * @throws PDOException
     */
    public function delete()
    {
        Post::delete($_POST['post']);
        return header('Location: /');
    }

    /**
     * Create api access point
     *
     * @return json|string
     * @throws PDOException
     */
    public function api()
    {
        header('Content-Type: application/json; charset=utf-8');

        if (isset($_GET['user_id'])) {
            $posts = Post::getByUser((int) $_GET['user_id']);

            if ($posts) {
                echo json_encode($posts, JSON_PRETTY_PRINT);
                return;
            }
        }

        echo 'empty data';
    }
}
