<?php

use App\Models\TwigInit;

function view($view, $atts = []): void
{
    $twig = TwigInit::getInstance();
    $atts['message'] = getMessage();

    echo $twig->env()->render($view . '.twig', $atts);
}

function setMessage($text = null): void
{
    $_SESSION['message'] = $text . "\n";
}

function getMessage(): string
{
    $message = $_SESSION['message'] ?? '';
    unset($_SESSION['message']);
    return $message;
}

function setAuthSession($email): void
{
    $_SESSION['email'] = $email;
}
