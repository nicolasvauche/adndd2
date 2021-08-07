<?php

namespace App\Form;

use App\Entity\Character;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class CharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('tribe')
            ->add('avatar', FileType::class,
                [
                    'required' => false,
                    'mapped' => false,
                    'label' => 'character.avatar.label',
                    'attr' => [
                        'class' => 'app_form_control',
                    ],
                    'constraints' => [
                        new File([
                            'maxSize' => '1024k',
                            'mimeTypes' => [
                                'image/jpeg',
                                'image/png',
                            ],
                            'mimeTypesMessage' => 'Choisis plutôt un fichier .jpg ou .png, ça marchera mieux ;)',
                        ])
                    ],
                ])
            ->add('name', TextType::class,
                [
                    'required' => true,
                    'label' => 'character.name.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'character.name.placeholder',
                    ],
                ])
            ->add('surname', TextType::class,
                [
                    'required' => false,
                    'label' => 'character.surname.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'character.surname.placeholder',
                    ],
                ])
            ->add('birthplace', TextType::class,
                [
                    'required' => false,
                    'label' => 'character.birthplace.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'character.birthplace.placeholder',
                    ],
                ])
            ->add('age', NumberType::class,
                [
                    'required' => false,
                    'label' => 'character.age.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'character.age.placeholder',
                        'min' => 1,
                    ],
                ])
            ->add('gender', TextType::class,
                [
                    'required' => true,
                    'label' => 'character.gender.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'character.gender.placeholder',
                    ],
                ])
            ->add('size', TextType::class,
                [
                    'required' => true,
                    'label' => 'character.size.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'character.size.placeholder',
                    ],
                ])
            ->add('weight', TextType::class,
                [
                    'required' => true,
                    'label' => 'character.weight.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'character.weight.placeholder',
                    ],
                ])
            ->add('guidingHand', TextType::class,
                [
                    'required' => true,
                    'label' => 'character.guidingHand.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'character.guidingHand.placeholder',
                    ],
                ])
            ->add('description', TextareaType::class,
                [
                    'required' => false,
                    'label' => 'character.description.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'character.description.placeholder',
                        'rows' => 5,
                    ],
                ])
            ->add('distinctive', TextareaType::class,
                [
                    'required' => false,
                    'label' => 'character.distinctive.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'character.distinctive.placeholder',
                        'rows' => 5,
                    ],
                ])
            ->add('homeplace', TextType::class,
                [
                    'required' => false,
                    'label' => 'character.homeplace.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'character.homeplace.placeholder',
                    ],
                ])
            ->add('occupation', TextType::class,
                [
                    'required' => false,
                    'label' => 'character.occupation.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'character.occupation.placeholder',
                    ],
                ])
            ->add('story', TextareaType::class,
                [
                    'required' => false,
                    'label' => 'character.story.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'character.story.placeholder',
                        'rows' => 5,
                    ],
                ])
            ->add('notes', TextareaType::class,
                [
                    'required' => false,
                    'label' => 'character.notes.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'character.notes.placeholder',
                        'rows' => 5,
                    ],
                ])
            ->add('allegiance', TextType::class,
                [
                    'required' => false,
                    'label' => 'character.allegiance.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'character.allegiance.placeholder',
                    ],
                ])
            ->add('coinpurse', TextType::class,
                [
                    'required' => true,
                    'label' => 'character.coinpurse.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'character.coinpurse.placeholder',
                    ],
                ])
            //->add('relatives')
            ->add('submit', SubmitType::class,
                [
                    'label' => 'character.submit.label',
                    'attr' => [
                        'class' => 'app_button cta',
                    ],
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Character::class,
        ]);
    }
}
