<?php

namespace App\Form;

use App\Entity\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Podane hasła nie są takie same',
            'options' => ['attr' => ['class' => 'password-field']],
            'required' => true,
            'first_options'  => ['label' => 'Nowe Hasło'],
            'second_options' => ['label' => 'Powtórz Hasło']])
        ->add('Zatwierdź', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'password' => Admin::class
        ]);
    }
}
