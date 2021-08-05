<?php

namespace App\Controller;

use App\Entity\Character;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

            $manager->persist($character);
            $manager->flush();

            $this->addFlash('success', 'Ton personnage a été créé !');
        } else {
            $this->addFlash('error', 'Hum… Erreur bizarre…');
        }

        return $this->redirectToRoute('user.characters');
    }

    /**
     * @Route("/supprimer-un-personnage/{id}", name="user.characters.remove")
     */
    public function remove(EntityManagerInterface $manager, $id): Response
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
}
