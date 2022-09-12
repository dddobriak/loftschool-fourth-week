<?php

namespace App\Services;

class SwiftMail
{
    private $transport;
    private $mailer;
    private $message;

    public function __construct()
    {
        // Create the Transport
        $mail = require_once ROOT . '/config/mail.php';

        $this->transport = (new \Swift_SmtpTransport($mail['host'], $mail['port'], 'ssl'))
            ->setUsername($mail['username'])
            ->setPassword($mail['password']);

        $this->setMailer();
        $this->setMessage();
    }

    /**
     * Set Mailer
     *
     * @return void
     */
    private function setMailer(): void
    {
        // Create the Mailer using your created Transport
        $this->mailer = new \Swift_Mailer($this->transport);
    }

    /**
     * Set Message
     *
     * @return void
     */
    private function setMessage(): void
    {
        // Create a message
        $this->message = (new \Swift_Message('Wonderful Subject'))
            ->setFrom(['loftschool.fourth@yandex.ru' => 'Pavel'])
            ->setTo(['ironerg@gmail.com'])
            ->setBody('Here is the message itself');
    }

    /**
     * Send message
     *
     * @return SwiftMail
     */
    public function send(): int
    {
        // Send the message
        return $this->mailer->send($this->message);
    }
}
