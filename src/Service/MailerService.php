<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
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
            $email = (new TemplatedEmail())
                ->from(new Address($this->globals->getAppEmail(), $this->globals->getAppAuthor()))
                ->to(new Address($mailData['email'], $mailData['name']))
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject($mailData['subject'])
                //->textTemplate('emails/contact/user.txt.twig')
                ->htmlTemplate($mailData['htmlTemplate'])
                ->context([
                    'mailData' => $mailData,
                ]);

        } else {
            $email = (new TemplatedEmail())
                ->from(new Address($this->globals->getAppEmail(), $this->globals->getAppAuthor()))
                ->to($mailData['to'] ? $mailData['to'] : new Address($this->globals->getAppEmail(), $this->globals->getAppAuthor()))
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                ->replyTo(new Address($mailData['email'], $mailData['name']))
                //->priority(Email::PRIORITY_HIGH)
                ->subject($mailData['subject'])
                //->textTemplate('emails/contact/user.txt.twig')
                ->htmlTemplate($mailData['htmlTemplate'])
                ->context([
                    'mailData' => $mailData,
                ]);
            //->html("<p>Bonjour, toi qui es Admin !</p><p>Voici le message d'un ami :</p><p>" . $mailData['message'] . "</p><hr /><p>Ave !</p>");

        }
        try {
            $this->mailer->send($email);
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
