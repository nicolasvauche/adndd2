<?php

namespace App\Controller;

use App\Repository\CmsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/qui-sommes-nous", name="about")
     */
    public function index(CmsRepository $cmsRepository): Response
    {
        $about = $cmsRepository->findOneBy(['type' => 'about']);

        return $this->render('about/index.html.twig',
            [
                'about' => $about,
            ]);
    }
}
