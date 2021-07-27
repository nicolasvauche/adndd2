<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,
                [
                    'required' => true,
                    'label' => 'user.profile.email.label',
                    'attr' => [
                        'autocomplete' => 'email',
                        'class' => 'app_form_control',
                    ],
                ])
            ->add('gender', ChoiceType::class,
                [
                    'required' => false,
                    'label' => 'user.profile.gender.label',
                    'attr' => [
                        'class' => 'app_form_control',
                    ],
                    'choices' => [
                        'Mme' => 'mme',
                        'Mr' => 'mr',
                    ],
                ])
            ->add('firstname', TextType::class,
                [
                    'label' => 'user.profile.firstname.label',
                    'attr' => [
                        'class' => 'app_form_control',
                    ],
                ])
            ->add('lastname', TextType::class,
                [
                    'label' => 'user.profile.lastname.label',
                    'attr' => [
                        'class' => 'app_form_control',
                    ],
                ])
            ->add('pseudo', TextType::class,
                [
                    'required' => false,
                    'label' => 'user.profile.pseudo.label',
                    'attr' => [
                        'class' => 'app_form_control',
                    ],
                ])
            ->add('submit', SubmitType::class,
                [
                    'label' => 'user.profile.submit.label',
                    'attr' => [
                        'class' => 'app_button cta',
                    ],
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
