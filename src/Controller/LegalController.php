<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalController extends AbstractController
{
    /**
     * @Route("/legal/{slug}", name="legal")
     */
    public function index($slug): Response
    {
        return $this->render('legal/index.html.twig', [
            'slug' => $slug,
        ]);
    }
}
