<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserEditForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(message: 'Email should be not blank'),
                    new Email(),
                ],
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
