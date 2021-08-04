<?php

namespace App\Controller;

use App\Repository\GameRepository;
use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(GameRepository $gameRepository): Response
    {
        $games = $gameRepository->findAll();

        return $this->render('default/index.html.twig', [
            'games' => $games,
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
