<?php

namespace App\Controller;

use App\Entity\Campaign;
use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/jouer-en-ligne/mes-campagnes")
 */
class CampaignController extends AbstractController
{
    /**
     * @Route("/", name="user.campaign")
     */
    public function index(): Response
    {
        $campaigns = $this->getDoctrine()->getRepository(Campaign::class)->findAll();
        $games = $this->getDoctrine()->getRepository(Game::class)->findAll();

        return $this->render('play/campaign/index.html.twig', [
            'campaigns' => $campaigns,
            'games' => $games,
        ]);
    }

    /**
     * @Route("/supprime-une-campagne/{id}", name="user.campaign.delete")
     */
    public function delete(EntityManagerInterface $manager, $id): Response
    {
        $campaign = $this->getDoctrine()->getRepository(Campaign::class)->find($id);

        if ($campaign) {
            foreach ($campaign->getScenarios() as $scenario) {
                $scenario->setCampaign(null);
                $manager->persist($scenario);
            }
            $manager->remove($campaign);
            $manager->flush();

            $this->addFlash('success', 'Ta campagne a été supprimée !');
        } else {
            $this->addFlash('error', 'Hum… Erreur bizarre…');
        }

        return $this->redirectToRoute('user.campaign');
    }
}
