<?php

use Bramus\Router\Router;

// Create Router instance
$router = new Router();

// Define routes
$router->get('/', 'App\Controllers\BlogController@create');
$router->get('/auth', 'App\Controllers\AuthController@create');
$router->post('/login', 'App\Controllers\AuthController@login');
$router->post('/register', 'App\Controllers\AuthController@register');
$router->post('/logout', 'App\Controllers\AuthController@logout');
$router->post('/addpost', 'App\Controllers\BlogController@addPost');
$router->post('/deletepost', 'App\Controllers\BlogController@delete');
$router->get('/api', 'App\Controllers\BlogController@api');

// Temporary servce routers
$router->get('/createtables', 'App\Controllers\MigrateController@create');
$router->get('/removetables', 'App\Controllers\MigrateController@remove');

// Send Email
$router->get('/sendemail', 'App\Services\SwiftMail@send');

// Edit image
$router->get('/convertimage', 'App\Services\ImageTask@convert');

// Define 404
$router->set404(function () {
    header('HTTP/1.1 404 Not Found');
    echo 'Хоба!';
});

// Run it!
$router->run();
