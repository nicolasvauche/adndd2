<?php

namespace App\Controller;

use App\Entity\Character;
use App\Entity\CharacterCharacteristic;
use App\Entity\CharacterSkill;
use App\Entity\CharacterSpell;
use App\Entity\EquipmentType;
use App\Entity\Equipment;
use App\Form\CharacterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

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

            foreach ($characterPremade->getEquipments() as $equipment) {
                $equipment->addCharacter($character);
                $manager->persist($equipment);
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
        return $this->render('character/sheet/index.html.twig', [
            'character' => $character,
        ]);
    }

    
    /**
     * @Route("/liste-des-equipements/{gameId}", name="user.characters.equipment")
     */

    public function equipement($gameId)
    {

        $equipmentTypes = $this->getDoctrine()->getRepository(EquipmentType::class)->findAllByGame($gameId);

        return new JsonResponse($equipmentTypes);
    }

    /**
     * @Route("/equipements-par-type/{equipmentTypeId}", name="user.characters.equipment_type")
     */

    public function equipementType(SerializerInterface $serializer, $equipmentTypeId)
    {

        $equipments = $this->getDoctrine()->getRepository(Equipment::class)->findBy(['equipmentType' => $equipmentTypeId]);

        $json = $serializer->serialize(
            $equipments,
            'json',
            ['groups' => 'show_equipment']
        );

        return new JsonResponse(json_decode($json));
    }
     
}
