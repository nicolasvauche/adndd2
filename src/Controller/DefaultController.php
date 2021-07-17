<?php

namespace App\Controller;

use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/mailtest")
     */
    public function mail(MailerService $mailerService): Response
    {
        $mailerService->send(
            [
                'email' => 'nvauche@gmail.com',
                'subject' => 'Test',
                'message' => 'Test',
            ],
            'user');

        $mailerService->send(
            [
                'email' => 'nvauche@gmail.com',
                'subject' => 'Test',
                'message' => 'Test',
            ],
            'admin');

        return $this->redirectToRoute('home');
    }
}
