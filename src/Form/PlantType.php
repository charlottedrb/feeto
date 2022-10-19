<?php

namespace App\Form;

use App\Entity\Plant;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PlantType extends AbstractType
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => $this->translator->trans('Plant_name')
                ],
            ])
            ->add('size', IntegerType::class, [
                'attr' => [
                    'placeholder' => $this->translator->trans('Size'),
                    'min' => 0,
                ],
            ])
            ->add('price', IntegerType::class, [
                'attr' => [
                    'placeholder' => $this->translator->trans('Price'),
                    'min' => 0,
                ],
            ])
            ->add('origin', TextType::class, [
                'attr' => [
                    'placeholder' => $this->translator->trans('Origin')
                ],
            ])
            ->add('complexity', IntegerType::class, [
                'attr' => [
                    'placeholder' => $this->translator->trans('Complexity'),
                    'min' => 0,
                    'max' => 5,
                ],
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'placeholder' => $this->translator->trans('Description'),
                    'rows' => 5,
                ],
            ])
            ->add('image_url', FileType::class, [
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/png',
                        ],
                        'mimeTypesMessage' => $this->translator->trans('ImageErrorMsg'),
                    ])
                ],
            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plant::class,
        ]);
    }
}
