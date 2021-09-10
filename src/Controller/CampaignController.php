<?php

namespace App\Controller;

use App\Entity\Campaign;
use App\Entity\Game;
use App\Form\CampaignType;
use App\Repository\CampaignRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
     * @Route("/cree-une-campagne/{gameId}", name="user.campaign.create")
     */
    public function create(CampaignRepository $campaignRepository, Request $request, ValidatorInterface $validator, EntityManagerInterface $manager, $gameId = null): Response
    {
        $campaign = new Campaign();
        $form = $this->createForm(CampaignType::class, $campaign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($campaign);
            $manager->flush();

            $this->addFlash('success', 'La campagne a été créée !');

            return $this->redirectToRoute('user.campaign');
        } else {
            $errors = $validator->validate($form);

            if (count($errors) > 0) {
                $this->addFlash('danger', $errors[0]->getMessage());
            }
        }

        return $this->render('play/campaign/form.html.twig',
            [
                'mode' => 'add',
                'form' => $form->createView(),
                'campaign' => $campaign,
            ]);
    }

    /**
     * @Route("/modifie-une-campagne/{id}", name="user.campaign.edit")
     */
    public function edit(Request $request, ValidatorInterface $validator, EntityManagerInterface $manager, Campaign $campaign)
    {
        $game = $campaign->getGame();
        $form = $this->createForm(CampaignType::class, $campaign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $campaign->setGame($game);
            $manager->persist($campaign);
            $manager->flush();

            $this->addFlash('success', 'La campagne a été modifiée.');

            return $this->redirectToRoute('user.campaign');
        } else {
            $errors = $validator->validate($form);

            if (count($errors) > 0) {
                $this->addFlash('danger', $errors[0]->getMessage());
            }
        }
        return $this->render('play/campaign/form.html.twig',
            [
                'mode' => 'edit',
                'form' => $form->createView(),
                'campaign' => $campaign,
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
