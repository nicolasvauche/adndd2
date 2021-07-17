<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/nos-jeux")
 */
class GamesController extends AbstractController
{
    /**
     * @Route("/", name="games")
     */
    public function index(): Response
    {
        return $this->render('games/index.html.twig');
    }
}
