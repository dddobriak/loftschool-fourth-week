<?php

namespace App\Controllers;

use App\Services\Migrate;

class MigrateController
{
    public function create()
    {
        Migrate::createUsersTable();
        Migrate::createPostsTable();

        return view('index');
    }

    public function remove()
    {
        Migrate::dropUsersTable();
        Migrate::dropPostsTable();

        return view('index');
    }
}
