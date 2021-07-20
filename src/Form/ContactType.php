<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contact_name', TextType::class,
                [
                    'required' => true,
                    'label' => 'contact.name.label',
                    'attr' => [
                        'class' => 'app-form-control',
                    ],
                ])
            ->add('contact_email', EmailType::class,
                [
                    'required' => true,
                    'label' => 'contact.email.label',
                    'attr' => [
                        'class' => 'app-form-control',
                    ],
                ])
            ->add('contact_subject', TextType::class,
                [
                    'required' => true,
                    'label' => 'contact.subject.label',
                    'attr' => [
                        'class' => 'app-form-control',
                    ],
                ])
            ->add('contact_message', TextareaType::class,
                [
                    'required' => true,
                    'label' => 'contact.message.label',
                    'attr' => [
                        'class' => 'app-form-control',
                        'rows' => 5,
                    ],
                ])
            ->add('submit', SubmitType::class,
                [
                    'label' => 'contact.submit.label',
                    'attr' => [
                        'class' => 'app-button cta',
                    ],
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
