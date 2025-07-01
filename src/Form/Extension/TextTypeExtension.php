<?php

namespace App\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TextTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Add custom logic here if needed
    }

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        // Add a custom CSS class to all text fields
        if ($options['add_custom_class']) {
            $view->vars['attr']['class'] = ($view->vars['attr']['class'] ?? '') . ' custom-text-field';
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'add_custom_class' => true,
        ]);
    }

    public static function getExtendedTypes(): iterable
    {
        // Extend the TextType
        return [TextType::class];
    }
}