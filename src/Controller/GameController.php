<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/nos-jeux")
 */
class GameController extends AbstractController
{
    /**
     * @Route("/", name="games")
     */
    public function index(GameRepository $gameRepository): Response
    {
        $games = $gameRepository->findAll();

        return $this->render('game/index.html.twig',
            [
                'games' => $games,
            ]);
    }
}
