<?php

namespace App\Form;

use App\Validator\Fak;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ChatFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextType::class, [
                'constraints' => [
                    new NotBlank(message: 'Chat message should be not blank'),
                    new Fak(), // Add your custom validator here
                ],
            ])
//            ->add('created_at', DateTimeType::class, [
//                'label' => 'Created At',
//            ])

//            ->add('password', PasswordType::class, [
//                'constraints' => [
//                    new NotBlank(message: 'Please enter a password'),
//                    new Length(min: 5, minMessage: 'Surely you can think of something longer than that!'),
//                ],
//                'always_empty' => false,
//            ])
//            ->add('terms', CheckboxType::class, [
//                'label' => 'Agree to terms2',
//                'constraints' => [
//                    new NotBlank(message: 'Please agree to the non-existent terms'),
//                ],
//            ])
                    ->add('send', SubmitType::class, [
                    'label' => 'Edit message',
            ])

        ;
    }
}