<?php

namespace App\Controller;

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
     * @Route("/creer-une-table/{gameId}", name="play.create")
     */
    public function create($gameId = null): Response
    {
        if (!$gameId) {
            return $this->redirectToRoute('home');
        }

        switch ($gameId) {
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

        return $this->render('play/create.html.twig',
            [
                'gameId' => $gameId,
                'gameName' => $gameName,
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

    /**
     * @Route("/", name="play")
     */
    public function index(): Response
    {
        return $this->render('play/index.html.twig');
    }
}
