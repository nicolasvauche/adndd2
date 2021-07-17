<?php

namespace App\Service;

use App\Service\ConfigService;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Message;

class MailerService
{
    private $mailer;
    private $globals;

    public function __construct(MailerInterface $mailer, ConfigService $globals)
    {
        $this->mailer = $mailer;
        $this->globals = $globals;
    }

    public function send($mailData, $recipient)
    {
        if ($recipient === 'user') {
            $email = (new Email())
                ->from($this->globals->getAppEmail())
                ->to($mailData['email'])
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Nouveau message : ' . $mailData['subject'])
                ->text($mailData['message'])
                ->html('<p>Bonjour, toi qui ne vis pas dans un grotte !</p><p>Voici ton message mon ami :</p><p>' . $mailData['message'] . '</p><hr /><p>À tout de suite en ligne !</p>');

        } else {
            $email = (new Email())
                ->from($this->globals->getAppEmail())
                ->to($this->globals->getAppEmail())
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                ->replyTo($mailData['email'])
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Nouveau message : ' . $mailData['subject'])
                ->text($mailData['message'])
                ->html("<p>Bonjour, toi qui es Admin !</p><p>Voici le message d'un ami :</p><p>" . $mailData['message'] . "</p><hr /><p>Ave !</p>");

        }
        try {
            $this->mailer->send($email);
        } catch (\Exception $e) {
            var_dump($e);
            exit;
        }
    }
}
