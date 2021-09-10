<?php

namespace App\Form;

use App\Entity\Campaign;
use App\Entity\Game;
use App\Repository\GameRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampaignType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('game', EntityType::class,
                [
                    'required' => true,
                    'class' => Game::class,
                    'choice_label' => 'name',
                    'label' => 'play.game.label',
                    'placeholder' => 'play.game.emptyData',
                    'attr' => [
                        'class' => 'app_form_control',
                    ],
                ])
            ->add('name', TextType::class,
                [
                    'required' => true,
                    'label' => 'campaign.name.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'campaign.name.placeholder',
                    ],
                ])
            ->add('description', CKEditorType::class,
                [
                    'required' => false,
                    'label' => 'campaign.description.label',
                    'config_name' => 'default',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'campaign.description.placeholder',
                        'rows' => 5,
                    ],
                ])
            ->add('shortDescription', CKEditorType::class,
                [
                    'required' => false,
                    'label' => 'campaign.shortdescription.label',
                    'config_name' => 'default',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'campaign.shortdescription.placeholder',
                        'rows' => 3,
                    ],
                ])
            ->add('submit', SubmitType::class,
                [
                    'label' => 'campaign.submit.label',
                    'attr' => [
                        'class' => 'app_button cta',
                    ],
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Campaign::class,
        ]);
    }
}
