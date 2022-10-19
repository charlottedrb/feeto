<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('username', TextType::class, [
                'attr' => [
                    'placeholder' => $this->translator->trans('Username'),
                ],
            ])
            ->add('first_name', TextType::class, [
                'attr' => [
                    'placeholder' => $this->translator->trans('FirstName'),
                ],
            ])
            ->add('last_name', TextType::class, [
                'attr' => [
                    'placeholder' => $this->translator->trans('LastName'),
                ],
            ])
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => $this->translator->trans('Title'),
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
