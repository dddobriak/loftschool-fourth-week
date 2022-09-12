<?php

namespace App\Models;

use Twig\Environment;

class TwigInit
{
    private static $instance = null;
    private $twig;
    public static $i = 0;

    private function __construct()
    {
        // Run twig
        $loader = new \Twig\Loader\FilesystemLoader(ROOT . '/app/Views');
        $this->twig = new \Twig\Environment($loader);
    }

    public function env(): Environment
    {
        return $this->twig;
    }

    public static function getInstance(): TwigInit
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}
