<?php

namespace App\Controller;

use App\Entity\Character;
use App\Entity\Scenario;
use App\Entity\ScenarioCharacter;
use App\Form\ScenarioType;
use App\Repository\GameRepository;
use App\Repository\ScenarioRepository;
use App\Service\MailerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/joue-en-ligne")
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
                foreach ($scenario->getScenarioCharacters() as $scenarioCharacter) {
                    if ($scenarioCharacter->getPersonnage()->getId() === $myCharacter->getId()) {
                        $myGames[] = $scenario;
                    }
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
     * @Route("/tes-scenarios", name="user.play.myscenarios")
     */
    public function myScenarios(): Response
    {
        $scenarios = $this->getDoctrine()->getRepository(Scenario::class)->findBy(['user' => $this->getUser()], ['startAt' => 'ASC']);

        return $this->render('play/myscenarios.html.twig',
            [
                'scenarios' => $scenarios,
            ]);
    }

    /**
     * @Route("/cree-un-scenario/{gameId}", name="user.play.create")
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
                ->setDescription($scenario->getShortDescription())
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
     * @Route("/modifie-un-scenario/{id}", name="user.play.edit")
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
     * @Route("/supprime-un-scenario/{id}", name="user.play.remove")
     */
    public function remove(EntityManagerInterface $manager, $id): Response
    {
        $scenario = $this->getDoctrine()->getRepository(Scenario::class)->find($id);

        if ($scenario) {
            $manager->remove($scenario);
            $manager->flush();

            $this->addFlash('success', 'Ton scénario a été supprimée !');
        } else {
            $this->addFlash('error', 'Hum… Erreur bizarre…');
        }

        return $this->redirectToRoute('user.play.myscenarios');
    }

    /**
     * @Route("/invite-des-joueurs/{id}", name="user.play.invite")
     */
    public function invite(Scenario $scenario): Response
    {

        return $this->render('play/invite.html.twig',
            [
                'scenario' => $scenario,
            ]);
    }

    /**
     * @Route("/postule-a-un-scenario/{id}", name="user.play.candidate")
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
     * @Route("/rejoins-un-scenario/{id}/{characterId}", name="user.play.join")
     */
    public function join(EntityManagerInterface $manager, MailerService $mailerService, Scenario $scenario, $characterId): Response
    {
        $character = $this->getDoctrine()->getRepository(Character::class)->find($characterId);

        if ($character) {
            if (!$scenario->getScenarioCharacters()->contains($character) && sizeof($scenario->getScenarioCharacters()) < 5) {
                $scenarioCharacter = new ScenarioCharacter();
                $scenarioCharacter->setPersonnage($character)
                    ->setScenario($scenario)
                    ->setIsAccepted(false);
                $manager->persist($scenarioCharacter);
                $scenario->addScenarioCharacter($scenarioCharacter);
                $manager->persist($scenario);
                $manager->flush();

                $mailerService->send(
                    [
                        'name' => $character->getFullname(),
                        'email' => $character->getUser()->getEmail(),
                        'subject' => 'Je postule pour ton scénario : ' . $scenario->getName(),
                        'message' =>
                            <<<EOF
<p>Bonjour Ô puissant MJ !</p>
<p>
    Je viens vers toi afin de te présenter mon humble candidature pour participer à ton scénario : {$scenario->getName()}<br />
    M'accepteras-tu ? J'attends ta réponse, mon mignon ;)
</p>
EOF,

                        'htmlTemplate' => 'emails/play/join/user.html.twig',
                    ],
                    'user');

                $mailerService->send(
                    [
                        'to' => $scenario->getUser()->getEmail(),
                        'name' => $character->getFullname(),
                        'email' => $character->getUser()->getEmail(),
                        'subject' => 'On vient de postuler pour ton scénario : ' . $scenario->getName(),
                        'message' =>
                            <<<EOF
<p>Salut à toi, MJ !</p>
<p>
    {$character->getFullname()}, personnage appartenant à {$character->getUser()->getFullname()}, vient de te proposer sa candidature pour participer à ton scénario : {$scenario->getName()}<br />
    L'accepteras-tu ? Il attend ta réponse, sois gentil ;)
</p>
EOF,

                        'htmlTemplate' => 'emails/play/join/admin.html.twig',
                    ],
                    'admin');

                $this->addFlash('success', 'Ta candidature a été envoyée au MJ. Attendons sa réponse…');
            } else {
                if ($scenario->getScenarioCharacters()->contains($character)) {
                    $this->addFlash('warning', 'Ta candidature a déjà été envoyée au MJ ! Attends sa réponse…');
                } else if (sizeof($scenario->getScenarioCharacters()) < 5) {
                    $this->addFlash('danger', 'Ce scénario est plein de persos, désolé :(');
                }
            }
        }

        return $this->redirectToRoute('play');
    }

    /**
     * @Route("/quitte-un-scenario/{id}/{characterId}", name="user.play.leave")
     */
    public function leave(EntityManagerInterface $manager, MailerService $mailerService, Scenario $scenario, $characterId): Response
    {
        $character = $this->getDoctrine()->getRepository(Character::class)->find($characterId);

        if ($character) {
            foreach ($scenario->getScenarioCharacters() as $scenarioCharacter) {
                if ($scenarioCharacter->getPersonnage()->getId() === $character->getId()) {
                    $manager->remove($scenarioCharacter);
                    $scenario->removeScenarioCharacter($scenarioCharacter);
                    $manager->persist($scenario);
                    $manager->flush();

                    $mailerService->send(
                        [
                            'name' => $character->getFullname(),
                            'email' => $character->getUser()->getEmail(),
                            'subject' => 'Je quitte ton scénario : ' . $scenario->getName(),
                            'message' =>
                                <<<EOF
<p>Bonjour Ô puissant MJ !</p>
<p>
    Je reviens vers toi afin de t'informer que je quitte ton scénario : {$scenario->getName()}<br />
    Sans rancune, hein ;)
</p>
EOF,

                            'htmlTemplate' => 'emails/play/leave/user.html.twig',
                        ],
                        'user');

                    $mailerService->send(
                        [
                            'to' => $scenario->getUser()->getEmail(),
                            'name' => $character->getFullname(),
                            'email' => $character->getUser()->getEmail(),
                            'subject' => 'On a quitté ton scénario : ' . $scenario->getName(),
                            'message' =>
                                <<<EOF
<p>Salut à toi, MJ !</p>
<p>
    {$character->getFullname()}, personnage appartenant à {$character->getUser()->getFullname()}, vient de quitter ton scénario : {$scenario->getName()}<br />
    On ne sait pas pourquoi, mais ce n'est sûrement rien de personnel :)
</p>
EOF,

                            'htmlTemplate' => 'emails/play/leave/admin.html.twig',
                        ],
                        'admin');

                    $this->addFlash('warning', 'Tu as quitté le scénario.');
                }
            }
        }

        return $this->redirectToRoute('play');
    }

    /**
     * @Route("/recherche-un-personnage/{scenarioId}/{characterName}/{deleteMode}/{acceptMode}", name="user.play.invite.search")
     */
    public function searchCharacter(Request $request, EntityManagerInterface $manager, MailerService $mailerService, $scenarioId, $characterName, $deleteMode = false, $acceptMode = false)
    {
        $json = [];
        $scenario = $this->getDoctrine()->getRepository(Scenario::class)->find($scenarioId);

        $character = $this->getDoctrine()->getRepository(Character::class)->createQueryBuilder('c')
            ->where('c.name LIKE :characterName')
            ->orWhere('c.surname LIKE :characterName')
            ->orWhere("CONCAT(c.name, ' ' , c.surname) LIKE :characterName")
            ->orWhere("CONCAT(u.firstname, ' ', u.lastname) LIKE :characterName")
            ->orWhere('u.pseudo LIKE :characterName')
            ->andWhere('c.isPremade = 0')
            ->andWhere('c.game = :gameId')
            ->setParameter('characterName', '%' . $characterName . '%')
            ->setParameter('gameId', $scenario->getGame()->getId())
            ->join('c.user', 'u')
            ->getQuery()
            ->getResult();

        if ($character) {
            if (is_array($character)) {
                foreach ($character as $char) {
                    if ($char->getUser()->getId() !== $this->getUser()->getId()) {
                        if ($deleteMode) {
                            $json[] = [
                                [
                                    'id' => $char->getId(),
                                    'fullname' => $char->getFullname(),
                                    'avatar' => $char->getAvatar(),
                                    'username' => $char->getUser()->getFullname(),
                                ],
                            ];
                        } else {
                            if ($acceptMode) {
                                $scenarioCharacter = $this->getDoctrine()->getRepository(ScenarioCharacter::class)->findOneBy(['personnage' => $char]);
                                $scenarioCharacter->setIsAccepted(true);
                                $manager->persist($scenarioCharacter);
                                $manager->flush();

                                $mailerService->send(
                                    [
                                        'name' => $char->getFullname(),
                                        'email' => $char->getUser()->getEmail(),
                                        'subject' => 'Tu as rejoins le scénario : ' . $scenario->getName(),
                                        'message' =>
                                            <<<EOF
<p>Salut {$char->getName()} !</p>
<p>
    Bonne nouvelle !<br />
    Le MJ du scénario : {$scenario->getName()} a accepté ta candidature !<br />
    C'est cool ;)
</p>
EOF,

                                        'htmlTemplate' => 'emails/play/accept/user.html.twig',
                                    ],
                                    'user');

                                $json[] = [
                                    [
                                        'id' => $char->getId(),
                                        'fullname' => $char->getFullname(),
                                        'avatar' => $char->getAvatar(),
                                        'username' => $char->getUser()->getFullname(),
                                    ],
                                ];
                            } else {
                                $playerExists = false;
                                foreach ($scenario->getScenarioCharacters() as $scenarioCharacter) {
                                    if ($scenarioCharacter->getPersonnage()->getId() === $char->getId()) {
                                        $playerExists = true;
                                    }
                                }

                                if (!$playerExists) {
                                    $json[] = [
                                        [
                                            'id' => $char->getId(),
                                            'fullname' => $char->getFullname(),
                                            'avatar' => $char->getAvatar(),
                                            'username' => $char->getUser()->getFullname(),
                                        ],
                                    ];
                                }
                            }
                        }
                    }
                }
            } else {
                if ($character->getUser()->getId() !== $this->getUser()->getId()) {
                    if ($deleteMode) {
                        $json = [
                            [
                                'id' => $character->getId(),
                                'fullname' => $character->getFullname(),
                                'avatar' => $character->getAvatar(),
                                'username' => $character->getUser()->getFullname(),
                            ],
                        ];
                    } else {
                        if ($acceptMode) {
                            $scenarioCharacter = $this->getDoctrine()->getRepository(ScenarioCharacter::class)->findOneBy(['personnage' => $character]);
                            $scenarioCharacter->setIsAccepted(true);
                            $manager->persist($scenarioCharacter);
                            $manager->flush();

                            $mailerService->send(
                                [
                                    'name' => $character->getFullname(),
                                    'email' => $character->getUser()->getEmail(),
                                    'subject' => 'Tu as rejoins le scénario : ' . $scenario->getName(),
                                    'message' =>
                                        <<<EOF
<p>Salut {$character->getName()} !</p>
<p>
    Bonne nouvelle !<br />
    Le MJ du scénario : {$scenario->getName()} a accepté ta candidature !<br />
    C'est cool ;)
</p>
EOF,

                                    'htmlTemplate' => 'emails/play/accept/user.html.twig',
                                ],
                                'user');

                            $json = [
                                [
                                    'id' => $character->getId(),
                                    'fullname' => $character->getFullname(),
                                    'avatar' => $character->getAvatar(),
                                    'username' => $character->getUser()->getFullname(),
                                ],
                            ];
                        } else {
                            $playerExists = false;
                            foreach ($scenario->getScenarioCharacters() as $scenarioCharacter) {
                                if ($scenarioCharacter->getPersonnage()->getId() === $character->getId()) {
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
        }

        return new JsonResponse($json);
    }

    /**
     * @Route("/invite-un-personnage/{id}/{characterId}", name="user.play.invite.character")
     */
    public function inviteCharacter(EntityManagerInterface $manager, MailerService $mailerService, Scenario $scenario, $characterId)
    {
        $json = [];
        $character = $this->getDoctrine()->getRepository(Character::class)->find($characterId);
        if ($character) {
            $scenarioCharacter = new ScenarioCharacter();
            $scenarioCharacter->setScenario($scenario)
                ->setPersonnage($character)
                ->setIsAccepted(true);
            $manager->persist($scenarioCharacter);
            $scenario->addScenarioCharacter($scenarioCharacter);
            $manager->persist($scenario);
            $manager->flush();

            $mailerService->send(
                [
                    'name' => $character->getFullname(),
                    'email' => $character->getUser()->getEmail(),
                    'subject' => 'Tu as été invité à jouer au scénario : ' . $scenario->getName(),
                    'message' =>
                        <<<EOF
<p>Salut à toi, {$character->getFullname()} !</p>
<p>
    Excellente nouvelle !<br />
    On vient de t'inviter à jouer au scénario {$scenario->getName()} !<br />
    Tu peux jouer ;)
</p>
EOF,

                    'htmlTemplate' => 'emails/play/invite/user.html.twig',
                ],
                'user');

            $json = [
                [
                    'id' => $character->getId(),
                    'fullname' => $character->getFullname(),
                    'avatar' => $character->getAvatar(),
                    'username' => $character->getUser()->getFullname(),
                ],
            ];
        }

        return new JsonResponse($json);
    }

    /**
     * @Route("/vire-un-personnage/{id}/{characterId}", name="user.play.invite.characters")
     */
    public function removeCharacter(EntityManagerInterface $manager, Scenario $scenario, $characterId)
    {
        $json = [];
        $character = $this->getDoctrine()->getRepository(Character::class)->find($characterId);
        if ($character) {
            $scenarioCharacter = $this->getDoctrine()->getRepository(ScenarioCharacter::class)->findOneBy(['personnage' => $character]);
            $manager->remove($scenarioCharacter);
            $manager->flush();
        }

        return new JsonResponse($json);
    }

    /**
     * @Route("/scenario/{id}", name="play.scenario")
     */
    public function scenario(?Scenario $scenario): Response
    {
        if (!$scenario) {
            return $this->redirectToRoute('play');
        }

        $myCharacter = null;

        foreach ($scenario->getScenarioCharacters() as $scenarioCharacter) {
            if ($scenarioCharacter->getPersonnage()->getUser()->getId() === $this->getUser()->getId() && $scenarioCharacter->getIsAccepted()) {
                $myCharacter = $scenarioCharacter->getPersonnage();
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
            if ($myCharacter->getName() !== 'MJ' && sizeof($scenario->getScenarioCharacters()) == 0) {
                return $this->redirectToRoute('play');
            }
        }

        return $this->render('play/scenario/index.html.twig',
            [
                'scenario' => $scenario,
                'myCharacter' => $myCharacter,
            ]);
    }
}
