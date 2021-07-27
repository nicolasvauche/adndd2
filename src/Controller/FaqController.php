<?php

namespace App\Controller;

use App\Repository\FaqRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FaqController extends AbstractController
{
    /**
     * @Route("/faq", name="faq")
     */
    public function index(FaqRepository $faqRepository): Response
    {
        $faq = $faqRepository->findAll();

        return $this->render('faq/index.html.twig',
            [
                'faq' => $faq,
            ]);
    }
}
