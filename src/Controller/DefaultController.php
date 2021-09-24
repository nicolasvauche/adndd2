<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Scenario;
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
        $games = $this->getDoctrine()->getRepository(Game::class)->findAll();
        $scenarios = $this->getDoctrine()->getRepository(Scenario::class)->findAll();

        return $this->render('default/index.html.twig', [
            'games' => $games,
            'scenarios' => $scenarios,
        ]);
    }

    /**
     * @Route("/mailtest")
     */
    public function mail(MailerService $mailerService): Response
    {
        $mailerService->send(
            [
                'name' => 'Monsieur Test',
                'email' => 'nvauche@gmail.com',
                'subject' => 'Test',
                'message' => 'Test',
                'htmlTemplate' => 'emails/test.html.twig',
            ],
            'user');

        $mailerService->send(
            [
                'name' => 'Monsieur Test',
                'email' => 'nvauche@gmail.com',
                'subject' => 'Test',
                'message' => 'Test',
                'htmlTemplate' => 'emails/test.html.twig',
            ],
            'admin');

        return $this->redirectToRoute('home');
    }
}
