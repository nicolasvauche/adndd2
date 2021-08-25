<?php

namespace App\Form;

use App\Entity\Campaign;
use App\Entity\Scenario;
use App\Repository\CampaignRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScenarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('campaign', EntityType::class,
                [
                    'required' => false,
                    'class' => Campaign::class,
                    'query_builder' => function (CampaignRepository $er) use ($options) {
                        return $er->createQueryBuilder('c')
                            ->where('c.game = :val')
                            ->setParameter('val', $options['data']->getGame()->getId());
                    },
                    'choice_label' => 'name',
                    'label' => 'play.game.campaign.label',
                    'placeholder' => 'play.game.campaign.emptyData',
                    'attr' => [
                        'class' => 'app_form_control',
                    ],
                ])
            ->add('name', TextType::class,
                [
                    'required' => true,
                    'label' => 'play.game.name.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'play.game.name.placeholder',
                    ],
                ])
            ->add('shortDescription', CKEditorType::class,
                [
                    'required' => false,
                    'label' => 'play.game.shortDescription.label',
                    'config_name' => 'default',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'play.game.shortDescription.placeholder',
                        'rows' => 5,
                    ],
                ])
            ->add('description', CKEditorType::class,
                [
                    'required' => false,
                    'label' => 'play.game.description.label',
                    'config_name' => 'default',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'play.game.description.placeholder',
                        'rows' => 7,
                    ],
                ])
            ->add('isPrivate', CheckboxType::class,
                [
                    'required' => false,
                    'label' => 'play.game.isPrivate.label',
                    'attr' => [
                        'class' => 'app_form_control',
                    ],
                ])
            ->add('startAt', DateTimeType::class,
                [
                    'required' => true,
                    'widget' => 'single_text',
                    'label' => 'play.game.startAt.label',
                    'attr' => [
                        'class' => 'app_form_control',
                    ],
                ])
            ->add('submit', SubmitType::class,
                [
                    'label' => 'play.game.submit.label',
                    'attr' => [
                        'class' => 'app_button cta',
                    ],
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Scenario::class,
        ]);
    }
}
