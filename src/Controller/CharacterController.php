<?php

namespace App\Controller;

use App\Entity\Character;
use App\Entity\CharacterCharacteristic;
use App\Entity\Characteristic;
use App\Entity\CharacterSkill;
use App\Entity\CharacterSpell;
use App\Form\CharacterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/tes-personnages")
 */
class CharacterController extends AbstractController
{
    /**
     * @Route("/", name="user.characters")
     */
    public function index(): Response
    {
        $characters = $this->getDoctrine()->getRepository(Character::class)->findBy(['user' => $this->getUser()]);

        return $this->render('character/index.html.twig', [
            'characters' => $characters,
        ]);
    }

    /**
     * @Route("/nouveau-personnage", name="user.characters.create")
     */
    public function create(): Response
    {
        $characters = $this->getDoctrine()->getRepository(Character::class)->findBy(['isPremade' => true]);

        return $this->render('character/create.html.twig', [
            'characters' => $characters,
        ]);
    }

    /**
     * @Route("/copier-un-personnage/{id}/{name}", name="user.characters.copy")
     */
    public function copy(EntityManagerInterface $manager, $id, $name = null): Response
    {
        $characterPremade = $this->getDoctrine()->getRepository(Character::class)->find($id);

        if ($characterPremade) {
            $character = clone $characterPremade;
            $character->setUser($this->getUser())
                ->setIsPremade(false);

            if ($name) {
                $character->setName($name);
            }

            foreach ($characterPremade->getCharacterSpells() as $characterSpellPremade) {
                $characterspell = new CharacterSpell();
                $characterspell->setCharacter($character)
                    ->setSpell($characterSpellPremade->getSpell())
                    ->setLevel($characterSpellPremade->getLevel());
                $manager->persist($characterspell);
            }

            foreach ($characterPremade->getCharacterSkills() as $characterSkillPremade) {
                $characterskill = new CharacterSkill();
                $characterskill->setCharacter($character)
                    ->setSkill($characterSkillPremade->getSkill())
                    ->setBase($characterSkillPremade->getBase());
                $manager->persist($characterskill);
            }

            foreach ($characterPremade->getCharacterCharacteristics() as $characterCharPremade) {
                $characterchar = new CharacterCharacteristic();
                $characterchar->setCharacter($character)
                    ->setCharacteristic($characterCharPremade->getCharacteristic())
                    ->setBase($characterCharPremade->getBase())
                    ->setModifyer($characterCharPremade->getModifyer());
                $manager->persist($characterchar);
            }

            foreach ($characterPremade->getSpecialties() as $specialty) {
                $specialty->addCharacter($character);
                $manager->persist($specialty);
            }
// Ajout des équipements par nouveau prétiré
            foreach ($characterPremade->getEquipments() as $equipment) {
                $equipment->addCharacter($character);
                $manager->persist($equipment);
            }
// fin ajout
            $manager->persist($character);

            $manager->flush();

            $this->addFlash('success', 'Ton personnage a été créé !');
        } else {
            $this->addFlash('error', 'Hum… Erreur bizarre…');
        }

        return $this->redirectToRoute('user.characters');
    }

    /**
     * @Route("/supprime-un-personnage/{id}", name="user.characters.delete")
     */
    public function delete(EntityManagerInterface $manager, $id): Response
    {
        $character = $this->getDoctrine()->getRepository(Character::class)->find($id);

        if ($character) {
            $manager->remove($character);
            $manager->flush();

            $this->addFlash('success', 'Ton personnage a été supprimé !');
        } else {
            $this->addFlash('error', 'Hum… Erreur bizarre…');
        }

        return $this->redirectToRoute('user.characters');
    }

    /**
     * @Route("/infos-personnage/{id}", name="user.characters.infos")
     */
    public function infos(Character $character): Response
    {
        return $this->render('character/infos.html.twig', [
            'character' => $character,
        ]);
    }

    /**
     * @Route("/modifie-un-personnage/{id}", name="user.characters.edit")
     */
    public function edit(Request $request, ValidatorInterface $validator, EntityManagerInterface $manager, Character $character)
    {
        $form = $this->createForm(CharacterType::class, $character);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avatar = $form->get('avatar')->getData();
            if ($avatar) {
                $originalFilename = pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $avatar->guessExtension();

                try {
                    $avatar->move(
                        $this->getParameter('asset_characters'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    dd($e);
                }

                $character->setAvatar($newFilename);
            }

            $manager->persist($character);
            $manager->flush();

            $this->addFlash('success', 'Ton personnage a été modifié.');

            return $this->redirectToRoute('user.characters');
        } else {
            $errors = $validator->validate($form);

            if (count($errors) > 0) {
                $this->addFlash('danger', $errors[0]->getMessage());
            }
        }
        return $this->render('character/form.html.twig',
            [
                'mode' => 'edit',
                'form' => $form->createView(),
                'character' => $character,
            ]);
    }

    /**
     * @Route("/feuille-de-personnage/{id}", name="user.characters.sheet")
     */
    public function sheet(Character $character): Response
    {
        $characterCharacteristics = $this->getDoctrine()->getRepository(CharacterCharacteristic::class)->findBy(['character' => $character]);
        $healthPoints = 50;
        $hitPoints = 50;
        $magicPoints = 50;
        $crazyPoints = 50;
        $pcRestPoints = 50;

        foreach ($characterCharacteristics as $characterCharacteristic) {
            if ($characterCharacteristic->getCharacteristic()->getShortname() === 'PV') {
                $healthPoints = $characterCharacteristic->getBase();
            }
            if ($characterCharacteristic->getCharacteristic()->getShortname() === 'PI') {
                $hitPoints = $characterCharacteristic->getBase();
            }
            if ($characterCharacteristic->getCharacteristic()->getShortname() === 'PM') {
                $magicPoints = $characterCharacteristic->getBase();
            }
            if ($characterCharacteristic->getCharacteristic()->getShortname() === 'PF') {
                $crazyPoints = $characterCharacteristic->getBase();
            }
            if ($characterCharacteristic->getCharacteristic()->getShortname() === 'PC') {
                $pcRestPoints = $characterCharacteristic->getBase();
            }
        }

        return $this->render('character/sheet/index.html.twig', [
            'character' => $character,
            'healthPoints' => $healthPoints,
            'hitPoints' => $hitPoints,
            'magicPoints' => $magicPoints,
            'crazyPoints' => $crazyPoints,
            'pcRestPoints' => $pcRestPoints,
        ]);
    }

    /**
     * @Route("/modifier-caracteristique-base/{id}/{shortName}/{value}", name="user.characters.editRange")
     */


    public function editRange(EntityManagerInterface $manager, Character $character, $shortName, $value)
    {
        
        $characterCharacteristics = $this->getDoctrine()->getRepository(CharacterCharacteristic::class)->findBy(['character' => $character]);
        $characteristic = null;
        $json = [];

        foreach ($characterCharacteristics as $characterCharacteristic) {
            if ($characterCharacteristic->getCharacteristic()->getShortname() === $shortName) {
                $characteristic = $characterCharacteristic->getCharacteristic();
                $characterCharacteristic->setBase($value);
                $manager->persist($characterCharacteristic);

            }
        }
        $manager->flush();

        if ($characteristic) {
            $json = [
                'message' => "La caractéristique '" . $characteristic->getName() . "' a été mise à " . $value
            ];
        } else {
            $json = [
                'message' => "La caractéristique n'existe pas pour ce personnage : Ceci est très probablement dû un bug dans les fixtures des personnages joueurs par défaut…"
            ];
        }

        return new JsonResponse($json);
    }


    /**
     * @Route("/modifier-argent/{id}/{value}", name="user.characters.editMoney")
     */


    public function editMoney(EntityManagerInterface $manager, Character $character, $value)
    {
        
        //$character = $this->getDoctrine()->getRepository(Character::class)->findBy(['character' => $character]);
        $json = [];


        $character->setCoinPurse($value);
        $manager->persist($character);

        $manager->flush();

        if ($character) {
            $json = [
                'message' => "La bourse a été mise à " . $value
            ];
        } else {
            $json = [
                'message' => "Pas de bourse pour ce personnage !"
            ];
        }

        return new JsonResponse($json);
    }
}
