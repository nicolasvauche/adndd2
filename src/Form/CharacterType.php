<?php

namespace App\Form;

use App\Entity\Character;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tribe')
            ->add('avatar')
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
            ->add('age')
            ->add('gender')
            ->add('size')
            ->add('weight')
            ->add('guidingHand')
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
            ->add('relatives')
            ->add('allegiance')
            ->add('coinpurse');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Character::class,
        ]);
    }
}
