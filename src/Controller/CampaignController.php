<?php

namespace App\Controller;

use App\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/campaign")
 */
class CampaignController extends AbstractController
{
    /**
     * @Route("/{id}", name="campaign")
     */
    public function index(Game $game): Response
    {
        $games = $this->getDoctrine()->getRepository(Game::class)->findAll();

        return $this->render('play/campaign/index.html.twig', [
            'game' => $game,
            'games' => $games,
        ]);
    }
}
