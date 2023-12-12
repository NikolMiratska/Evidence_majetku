<?php

namespace App\Form;

use App\Entity\AssetType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditTypeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', TextType::class, [
                'required' => false,
                'label' => 'Název',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:bg-gray-700 border-purple-400 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Název druhu',
                ),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AssetType::class,
        ]);
    }
}