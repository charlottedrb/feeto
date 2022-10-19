<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('username', TextType::class, [
                'attr' => [
                    'placeholder' => 'Username',
                ],
            ])
            ->add('first_name', TextType::class, [
                'attr' => [
                    'placeholder' => 'First name',
                ],
            ])
            ->add('last_name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Last name',
                ],
            ])
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => 'Title',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
