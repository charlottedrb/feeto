<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationFormType extends AbstractType
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => [
                    'placeholder' => $this->translator->trans('Username'),
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => $this->translator->trans('Email')
                ]
            ])
            ->add('first_name', TextType::class, [
                'attr' => [
                    'placeholder' => $this->translator->trans('FirstName')
                ]
            ])
            ->add('last_name', TextType::class, [
                'attr' => [
                    'placeholder' => $this->translator->trans('LastName')
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => $this->translator->trans('Password')
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => $this->translator->trans('EnterPassword'),
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => $this->translator->trans('PasswordMinMsg') . "{{ limit }}'" . $this->translator->trans('Characters'),
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
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
