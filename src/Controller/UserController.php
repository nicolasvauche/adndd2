<?php

namespace App\Controller;

use App\Form\LoginType;
use App\Form\UserPasswordType;
use App\Form\UserProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/connexion", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/login.html.twig',
            [
                'last_username' => $lastUsername,
                'error' => $error,
            ]
        );
    }

    /**
     * @Route("/deconnexion", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/ton-profil", name="user.profile")
     */
    public function profile(Request $request, EntityManagerInterface $manager, ValidatorInterface $validator): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(UserProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $manager->persist($user);

            $manager->flush();

            $this->addFlash('success', 'ton profil a été sauvegardé');

            return $this->redirect($request->getUri());
        } else {
            $errors = $validator->validate($user);
            if (count($errors) > 0) {
                $this->addFlash('danger', 'user.profile.errors.unique');
            }
        }

        return $this->render('user/profile.html.twig',
            [
                'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/modifie-ton-mot-de-passe", name="user.password")
     */
    public function password(Request $request, EntityManagerInterface $manager, ValidatorInterface $validator, UserPasswordEncoderInterface $encoder): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(UserPasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($encoder->encodePassword($user, $form->get('password')->getData()));
            $manager->persist($user);

            $manager->flush();

            $this->addFlash('success', 'ton mot de passe a été modifié');

            return $this->render('user/profile.html.twig',
                [
                    'form' => $form->createView(),
                ]);
        } else {
            $errors = $validator->validate($form);

            if (count($errors) > 0) {
                $this->addFlash('danger', $errors[0]->getMessage());
            }
        }

        return $this->render('user/password.html.twig',
            [
                'form' => $form->createView(),
            ]);
    }
}
