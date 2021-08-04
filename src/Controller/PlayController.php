<?php

namespace App\Controller;

use App\Entity\Scenario;
use App\Entity\User;
use App\Form\ScenarioType;
use App\Repository\GameRepository;
use App\Repository\ScenarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
    public function create(GameRepository $gameRepository, Request $request, ValidatorInterface $validator, EntityManagerInterface $manager, $gameId = null): Response
    {
        if (!$gameId) {
            return $this->redirectToRoute('games');
        }

        $game = $gameRepository->find($gameId);
        if (!$game) {
            return $this->redirectToRoute('games');
        }

        $scenario = new Scenario();
        $form = $this->createForm(ScenarioType::class, $scenario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $scenario->setStatus('waiting')
                ->setDescription('<p>' . $scenario->getShortDescription() . '</p>')
                ->setGame($game)
                ->setUser($this->getUser());
            $manager->persist($scenario);
            $manager->flush();

            $this->addFlash('success', 'La partie a été créée ! Invitons quelques joueurs, maintenant…');

            return $this->redirectToRoute('play.invite', ['id' => $scenario->getId()]);
        } else {
            $errors = $validator->validate($form);

            if (count($errors) > 0) {
                $this->addFlash('danger', $errors[0]->getMessage());
            }
        }

        return $this->render('play/form.html.twig',
            [
                'mode' => 'add',
                'game' => $game,
                'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/modifier-une-table/{id}", name="play.edit")
     */
    public function edit(Request $request, ValidatorInterface $validator, EntityManagerInterface $manager, Scenario $scenario)
    {
        $form = $this->createForm(ScenarioType::class, $scenario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($scenario);
            $manager->flush();

            $this->addFlash('success', 'La partie a été modifiée.');

            return $this->redirectToRoute('user.play.myscenarios');
        } else {
            $errors = $validator->validate($form);

            if (count($errors) > 0) {
                $this->addFlash('danger', $errors[0]->getMessage());
            }
        }
        return $this->render('play/form.html.twig',
            [
                'mode' => 'edit',
                'game' => $scenario->getGame(),
                'form' => $form->createView(),
                'scenario' => $scenario,
            ]);
    }

    /**
     * @Route("/inviter-des-joueurs/{id}", name="play.invite")
     */
    public function invite(Request $request, ValidatorInterface $validator, EntityManagerInterface $manager, Scenario $scenario): Response
    {

        return $this->render('play/invite.html.twig',
            [
                'scenario' => $scenario,
            ]);
    }

    /**
     * @Route("/rechercher-un-joueur/{playerName}", name="play.invite.player")
     */
    public function invitePlayer(Request $request, $playerName)
    {
        $player = $this->getDoctrine()->getRepository(User::class)->createQueryBuilder('u')
            ->where('u.pseudo LIKE :playerName')
            ->orWhere('u.firstname LIKE :playerName')
            ->orWhere('u.lastname LIKE :playerName')
            ->orWhere("CONCAT(u.firstname, ' ' , u.lastname) LIKE :playerName")
            ->setParameter('playerName', '%' . $playerName . '%')
            ->getQuery()
            ->getOneOrNullResult();

        if ($player) {
            $json = [
                [
                    'id' => $player->getId(),
                    'fullname' => $player->getFullname(),
                    'pseudo' => $player->getPseudo(),
                ],
            ];
        } else {
            $json = [];
        }

        return new JsonResponse($json);
    }

    /**
     * @Route("/tes-tables-de-jeu", name="user.play.myscenarios")
     */
    public function myScenarios(): Response
    {
        $scenarios = $this->getDoctrine()->getRepository(Scenario::class)->findBy(['user' => $this->getUser()]);

        return $this->render('play/mytables.html.twig',
            [
                'scenarios' => $scenarios,
            ]);
    }
}
