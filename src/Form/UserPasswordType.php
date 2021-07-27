<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;

class UserPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', RepeatedType::class,
                [
                    'required' => true,
                    'type' => PasswordType::class,
                    'empty_data' => '',
                    'invalid_message' => 'resetpassword.reset.errors.mismatch',
                    'options' => [
                        'attr' =>
                            [
                                'class' => 'app_form_control',
                            ],
                    ],
                    'first_options' =>
                        [
                            'label' => 'resetpassword.reset.first.label',
                            'constraints' => [
                                new NotNull([
                                    'message' => 'Please enter a password',
                                ]),
                                new Length([
                                    'min' => 6,
                                    'minMessage' => 'resetpassword.reset.errors.length',
                                    // max length allowed by Symfony for security reasons
                                    'max' => 4096,
                                ]),
                            ],
                        ],
                    'second_options' =>
                        [
                            'label' => 'resetpassword.reset.second.label',
                            'mapped' => false,
                        ],
                ])
            ->add('submit', SubmitType::class,
                [
                    'label' => 'resetpassword.reset.submit.label',
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
