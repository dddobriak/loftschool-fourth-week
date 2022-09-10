<?php

session_start();

// Require global constants
require_once __DIR__ . '/constants.php';

// Require helper functions
require_once __DIR__ . '/helpers.php';

// Require composer autoloader
require_once ROOT . '/vendor/autoload.php';

// Require router instance
require_once ROOT . '/config/router.php';
