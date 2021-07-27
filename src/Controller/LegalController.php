<?php

namespace App\Controller;

use App\Repository\CmsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalController extends AbstractController
{
    /**
     * @Route("/legal/{slug}", name="legal")
     */
    public function index(CmsRepository $cmsRepository, $slug): Response
    {
        $legal = $cmsRepository->findOneBy(['slug' => $slug]);

        return $this->render('legal/index.html.twig', [
            'legal' => $legal,
        ]);
    }
}
