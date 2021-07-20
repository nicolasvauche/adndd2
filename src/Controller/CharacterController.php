<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tes-personnages")
 */
class CharacterController extends AbstractController
{
    /**
     * @Route("/", name="characters")
     */
    public function index(): Response
    {
        $characters = [
            0 => [
                'id' => 1,
                'gameId' => 1,
                'gameName' => 'Donjons & Dragons',
                'name' => 'Emyl Zorak'
            ],
            1 => [
                'id' => 2,
                'gameId' => 2,
                'gameName' => 'Chroniques Oubliées',
                'name' => 'Lucius Blenneq'
            ],
            2 => [
                'id' => 3,
                'gameId' => 3,
                'gameName' => "L'appel de Cthulhu",
                'name' => 'Henri Leconte'
            ],
        ];

        return $this->render('character/index.html.twig', [
            'characters' => $characters,
        ]);
    }
}
