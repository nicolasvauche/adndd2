<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\ExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("/contactons-nous", name="contact")
     */
    public function index(Request $request, ValidatorInterface $validator, MailerService $mailerService): Response
    {
        $form = $this->createForm(ContactType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mailerService->send(
                [
                    'name' => $form->get('contact_name')->getData(),
                    'email' => $form->get('contact_email')->getData(),
                    'subject' => $form->get('contact_subject')->getData(),
                    'message' => $form->get('contact_message')->getData(),
                    'htmlTemplate' => 'emails/contact/user.html.twig',
                ],
                'user');

            $mailerService->send(
                [
                    'name' => $form->get('contact_name')->getData(),
                    'email' => $form->get('contact_email')->getData(),
                    'subject' => $form->get('contact_subject')->getData(),
                    'message' => $form->get('contact_message')->getData(),
                    'htmlTemplate' => 'emails/contact/admin.html.twig',
                ],
                'admin');

            $this->addFlash('success', 'ton message a été envoyé !');

            return $this->redirect($request->getUri());
        } else {
            $errors = $validator->validate($form);

            if (count($errors) > 0) {
                $this->addFlash('danger', $errors[0]->getMessage());
            }
        }

        return $this->render('contact/index.html.twig',
            [
                'form' => $form->createView(),
            ]);
    }
}
