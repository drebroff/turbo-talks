<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Intl\Languages;

class UserEditForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $a = Languages::getNames(); // If you want to override the built-in choices of the language type, you will also have to set the choice_loader option to null.

        $c = 13;
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(message: 'Email should be not blank'),
                    new Email(),
                ],
            ])
            ->add('language', ChoiceType::class, [
                'choice_loader' => null, // HERE
                'choices' => $a,
//                'choices' => [
//                    'English' => 'en',
//                    'Spanish' => 'es',
//                    'Bork' => 'muppets',
//                    'Pirate' => 'arr',
//                ],
                'preferred_choices' => ['muppets', 'arr'],
                'duplicate_preferred_choices' => false,
            ])
//            ->add('roles')
//            ->add('password')
            ->add('birthday', DateType::class, [
                'constraints' => [
                    new NotBlank(message: 'Put sum dates here'),
//                    new Email(),
                ],
            ])
//            ->add('name')
            ->add('send', SubmitType::class, [
                'label' => 'Edit user']
            );
    }

//    public function configureOptions(OptionsResolver $resolver): void
//    {
//        $resolver->setDefaults([
//            'data_class' => User::class,
//        ]);
//    }
}
