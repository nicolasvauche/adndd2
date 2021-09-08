<?php

namespace App\Controller;

use App\Entity\Campaign;
use App\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/jouer-en-ligne/mes-campagnes")
 */
class CampaignController extends AbstractController
{
    /**
     * @Route("/", name="campaign")
     */
    public function index(): Response
    {
        $campaigns = $this->getDoctrine()->getRepository(Campaign::class)->findAll();
        $games = $this->getDoctrine()->getRepository(Game::class)->findAll();

        return $this->render('play/campaign/index.html.twig', [
            'campaigns' => $campaigns,
            'games' => $games,
        ]);
    }
}
