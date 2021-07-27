<?php

namespace App\Form;

use App\Entity\Scenario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScenarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('campaign')
            ->add('name', TextType::class,
                [
                    'required' => true,
                    'label' => 'play.game.name.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'play.game.name.placeholder',
                    ],
                ])
            ->add('status')
            ->add('isPrivate')
            ->add('startAt');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Scenario::class,
        ]);
    }
}
