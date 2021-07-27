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
                        'class' => 'app_form_control',
                        'placeholder' => 'contact.name.placeholder',
                    ],
                ])
            ->add('contact_email', EmailType::class,
                [
                    'required' => true,
                    'label' => 'contact.email.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'contact.email.placeholder',
                    ],
                ])
            ->add('contact_subject', TextType::class,
                [
                    'required' => true,
                    'label' => 'contact.subject.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'contact.subject.placeholder',
                    ],
                ])
            ->add('contact_message', TextareaType::class,
                [
                    'required' => true,
                    'label' => 'contact.message.label',
                    'attr' => [
                        'class' => 'app_form_control',
                        'placeholder' => 'contact.message.placeholder',
                        'rows' => 5,
                    ],
                ])
            ->add('submit', SubmitType::class,
                [
                    'label' => 'contact.submit.label',
                    'attr' => [
                        'class' => 'app_button cta',
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
