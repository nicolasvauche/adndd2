<?php

namespace App\Controller;

use App\Entity\Character;
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

    /**
     * @Route("/creer-une-table/{gameId}", name="user.play.create")
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
        $scenario->setGame($game);
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

            return $this->redirectToRoute('user.play.invite', ['id' => $scenario->getId()]);
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
                'scenario' => $scenario,
            ]);
    }

    /**
     * @Route("/modifier-une-table/{id}", name="user.play.edit")
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
     * @Route("/supprimer-une-table/{id}", name="user.play.remove")
     */
    public function remove(EntityManagerInterface $manager, $id): Response
    {
        $scenario = $this->getDoctrine()->getRepository(Scenario::class)->find($id);

        if ($scenario) {
            $manager->remove($scenario);
            $manager->flush();

            $this->addFlash('success', 'Ta table de jeu a été supprimée !');
        } else {
            $this->addFlash('error', 'Hum… Erreur bizarre…');
        }

        return $this->redirectToRoute('user.play.myscenarios');
    }

    /**
     * @Route("/inviter-des-joueurs/{id}", name="user.play.invite")
     */
    public function invite(Scenario $scenario): Response
    {

        return $this->render('play/invite.html.twig',
            [
                'scenario' => $scenario,
            ]);
    }

    /**
     * @Route("/rechercher-un-personnage/{scenarioId}/{characterName}/{deleteMode}", name="user.play.invite.character")
     */
    public function inviteCharacter(Request $request, EntityManagerInterface $manager, $scenarioId, $characterName, $deleteMode = false)
    {
        $json = [];
        $scenario = $this->getDoctrine()->getRepository(Scenario::class)->find($scenarioId);

        $character = $this->getDoctrine()->getRepository(Character::class)->createQueryBuilder('c')
            ->where('c.name LIKE :characterName')
            ->orWhere('c.surname LIKE :characterName')
            ->orWhere("CONCAT(c.name, ' ' , c.surname) LIKE :characterName")
            ->andWhere('c.isPremade = 0')
            ->andWhere('c.game = :gameId')
            ->setParameter('characterName', '%' . $characterName . '%')
            ->setParameter('gameId', $scenario->getGame()->getId())
            ->getQuery()
            ->getOneOrNullResult();

        if ($character) {
            if ($deleteMode) {
                $scenario->addCharacter($character);
                $manager->persist($scenario);
                $manager->flush();

                $json = [
                    [
                        'id' => $character->getId(),
                        'fullname' => $character->getFullname(),
                        'avatar' => $character->getAvatar(),
                        'username' => $character->getUser()->getFullname(),
                    ],
                ];
            } else {
                if (!$scenario->getCharacters()->contains($character) && sizeof($scenario->getCharacters()) < 5) {
                    $scenario->addCharacter($character);
                    $manager->persist($scenario);
                    $manager->flush();

                    $json = [
                        [
                            'id' => $character->getId(),
                            'fullname' => $character->getFullname(),
                            'avatar' => $character->getAvatar(),
                            'username' => $character->getUser()->getFullname(),
                        ],
                    ];
                }
            }
        }

        return new JsonResponse($json);
    }

    /**
     * @Route("/virer-un-personnage/{id}/{characterId}", name="user.play.invite.characters")
     */
    public function removeCharacter(Request $request, EntityManagerInterface $manager, Scenario $scenario, $characterId)
    {
        $json = [];
        $character = $this->getDoctrine()->getRepository(Character::class)->find($characterId);
        if ($character) {
            $scenario->removeCharacter($character);
            $manager->persist($scenario);
            $manager->flush();
        }

        return new JsonResponse($json);
    }
}
