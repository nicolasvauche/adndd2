<?php

namespace App\Controller;

use App\Entity\Character;
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
}
