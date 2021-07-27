<?php

namespace App\Controller;

use App\Repository\ScenarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/jouer-en-ligne")
 */
class PlayController extends AbstractController
{
    /**
     * @Route("/", name="play")
     */
    public function index(ScenarioRepository $scenarioRepository): Response
    {
        $scenarios = $scenarioRepository->findAll();

        $games = [
            0 => [
                'id' => 2,
                'name' => 'Donjons & Dragons',
            ],
            1 => [
                'id' => 3,
                'name' => 'Chroniques Oubliées',
            ],
            2 => [
                'id' => 4,
                'name' => "L'appel de Cthulhu",
            ],
        ];

        return $this->render('play/index.html.twig',
            [
                'scenarios' => $scenarios,
                'games' => $games,
            ]);
    }

    /**
     * @Route("/creer-une-table/{gameId}", name="play.create")
     */
    public function create($gameId = null): Response
    {
        if (!$gameId) {
            return $this->redirectToRoute('home');
        }

        $games = [
            0 => [
                'id' => 1,
                'name' => 'Donjons & Dragons',
            ],
            1 => [
                'id' => 2,
                'name' => 'Chroniques Oubliées',
            ],
            2 => [
                'id' => 3,
                'name' => "L'appel de Cthulhu",
            ],
        ];

        switch ($gameId) {
            case 1:
                $gameName = $games[0]['name'];
                break;
            case 2:
                $gameName = $games[1]['name'];
                break;
            case 3:
                $gameName = $games[2]['name'];
                break;
            default:
                $gameName = $gameId;
                break;
        }

        return $this->render('play/create.html.twig',
            [
                'gameId' => $gameId,
                'gameName' => $gameName,
                'games' => $games,
            ]);
    }

    /**
     * @Route("/inviter-des-joueurs", name="play.invite")
     */
    public function invite(): Response
    {
        if (isset($_POST['play_game_id'])) {
            $gameId = $_POST['play_game_id'];

            switch ($_POST['play_game_id']) {
                case 1:
                    $gameName = 'Donjons & Dragons';
                    break;
                case 2:
                    $gameName = 'Chroniques Oubliées';
                    break;
                case 3:
                    $gameName = "L'appel de Cthulhu";
                    break;
                default:
                    $gameName = $gameId;
                    break;
            }
        } else {
            return $this->redirectToRoute('home');
        }

        return $this->render('play/invite.html.twig',
            [
                'gameId' => $gameId,
                'gameName' => $gameName,
                'formData' => $_POST,
            ]);
    }
}
