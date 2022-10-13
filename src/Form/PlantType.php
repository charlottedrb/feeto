<?php

namespace App\Form;

use App\Entity\Plant;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PlantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Name'
                ],
            ])
            ->add('size', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Size',
                    'min' => 0,
                ],
            ])
            ->add('price', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Price',
                    'min' => 0,
                ],
            ])
            ->add('origin', TextType::class, [
                'attr' => [
                    'placeholder' => 'Origin'
                ],
            ])
            ->add('complexity', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Complexity',
                    'min' => 0,
                    'max' => 5,
                ],
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Description',
                    'rows' => 5,
                ],
            ])
            ->add('image_url', FileType::class, [
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PNG image.',
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
