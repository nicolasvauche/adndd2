<?php

namespace App\Controller;

use App\Entity\Character;
use App\Entity\Scenario;
use App\Form\ScenarioType;
use App\Repository\GameRepository;
use App\Repository\ScenarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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

        return $this->render('play/index.html.twig',
            [
                'scenarios' => $scenarios,
            ]);
    }

    /**
     * @Route("/tes-aventures", name="user.play.mygames")
     */
    public function myGames(): Response
    {
        $scenarios = $this->getDoctrine()->getRepository(Scenario::class)->findAll();
        $myGames = [];

        foreach ($scenarios as $scenario) {
            $myCharacters = $this->getDoctrine()->getRepository(Character::class)->findBy(
                [
                    'game' => $scenario->getGame()->getId(),
                    'user' => $this->getUser(),
                ]
            );

            foreach ($myCharacters as $myCharacter) {
                if ($scenario->getCharacters()->contains($myCharacter)) {
                    $myGames[] = $scenario;
                }
            }
        }

        $myCharacters = $this->getDoctrine()->getRepository(Character::class)->findBy(['user' => $this->getUser()]);

        return $this->render('play/mygames.html.twig',
            [
                'myGames' => $myGames,
                'myCharacters' => $myCharacters,
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
     * @Route("/postule-a-une-table/{id}", name="user.play.candidate")
     */
    public function candidate(Scenario $scenario): Response
    {
        $hasCharacter = false;
        $myCharacters = [];

        foreach ($this->getUser()->getCharacters() as $myCharacter) {
            if ($myCharacter->getGame()->getId() === $scenario->getGame()->getId()) {
                $hasCharacter = true;
                $myCharacters[] = $myCharacter;
            }
        }

        if ($hasCharacter) {
            //$this->addFlash('success', 'Le MJ est prévenu. On attend désormais sa réponse…');
        } else {
            $this->addFlash('danger', "Tu n'as aucun personnage pour jouer à ce jeu :/");
            return $this->redirectToRoute('user.characters');
        }

        return $this->render('play/join.html.twig',
            [
                'myCharacters' => $myCharacters,
                'scenario' => $scenario,
            ]
        );
    }

    /**
     * @Route("/rejoins-une-table/{id}/{characterId}", name="user.play.join")
     */
    public function join(Scenario $scenario, $characterId): Response
    {
        $character = $this->getDoctrine()->getRepository(Character::class)->find($characterId);

        dd("Rejoins la table " . $scenario->getName() . " avec " . $character->getFullname());

        $this->addFlash('succes', 'Ta candidature a été envoyée au MJ. Attendons sa réponse…');

        return $this->redirectToRoute('play');
    }

    /**
     * @Route("/rechercher-un-personnage/{scenarioId}/{characterName}/{deleteMode}", name="user.play.invite.search")
     */
    public function searchCharacter(Request $request, EntityManagerInterface $manager, $scenarioId, $characterName, $deleteMode = false)
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
            if ($character->getUser()->getId() !== $this->getUser()->getId()) {
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
                    if (!$scenario->getCharacters()->contains($character)) {
                        $playerExists = false;
                        foreach ($scenario->getCharacters() as $key => $invited) {
                            if ($invited->getUser()->getId() == $character->getUser()->getId()) {
                                $playerExists = true;
                            }
                        }

                        if (!$playerExists) {
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
            }
        }

        return new JsonResponse($json);
    }

    /**
     * @Route("/inviter-un-personnage/{id}/{characterId}", name="user.play.invite.character")
     */
    public function inviteCharacter(EntityManagerInterface $manager, Scenario $scenario, $characterId)
    {
        $json = [];
        $character = $this->getDoctrine()->getRepository(Character::class)->find($characterId);
        if ($character) {
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

        return new JsonResponse($json);
    }

    /**
     * @Route("/virer-un-personnage/{id}/{characterId}", name="user.play.invite.characters")
     */
    public function removeCharacter(EntityManagerInterface $manager, Scenario $scenario, $characterId)
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

    /**
     * @Route("/table-de-jeu/{id}", name="play.scenario")
     */
    public function scenario(Scenario $scenario): Response
    {
        $myCharacter = null;

        foreach ($scenario->getCharacters() as $key => $character) {
            if ($character->getUser()->getId() === $this->getUser()->getId()) {
                $myCharacter = $character;
            }
        }

        if ($scenario->getUser()->getId() == $this->getUser()->getId()) {
            $myCharacter = new Character();
            $myCharacter->setGame($scenario->getGame())
                ->setUser($this->getUser())
                ->setIsPremade(false)
                ->setName('MJ');
        }

        if (!$myCharacter) {
            return $this->redirectToRoute('play');
        } else {
            if ($myCharacter->getName() !== 'MJ' && sizeof($scenario->getCharacters()) == 0) {
                return $this->redirectToRoute('play');
            }
        }

        return $this->render('play/table/index.html.twig',
            [
                'scenario' => $scenario,
                'myCharacter' => $myCharacter,
            ]);
    }
}
