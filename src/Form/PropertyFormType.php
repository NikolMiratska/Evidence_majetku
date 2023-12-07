<?php

namespace App\Form;

use App\Entity\AssetsCategory;
use App\Entity\AssetsLocation;
use App\Entity\AssetsManager;
use App\Entity\AssetsWorkplace;
use App\Entity\AssetType;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class PropertyFormType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('newType', TextType::class, [
            'mapped' => false,
            'required' => false,
            'label' => 'Přidat nový druh',
            'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
            'attr' => array(
                'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                'placeholder' => 'Přidat nový druh',
            ),
        ])
        ->add('newLocation', TextType::class, [
            'mapped' => false,
            'required' => false,
            'label' => 'Přidat novou lokaci',
            'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
            'attr' => array(
                'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                'placeholder' => 'Přidat novou lokaci',
            ),
        ])
        ->add('newOwner', TextType::class, [
//                'class' => User::class,
            'mapped' => false,
            'required' => false,
            'label' => 'Přidat nového držitele',
            'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
            'attr' => array(
                'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                'placeholder' => 'Přidat nového držitele',
            ),
        ])
        ->add('newCategory', TextType::class, [
            'mapped' => false,
            'required' => false,
            'label' => 'Přidat novou kategorii',
            'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
            'attr' => array(
                'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                'placeholder' => 'Přidat novou kategorii',
            ),
        ])
        ->add('newWorkplace', TextType::class, [
            'mapped' => false,
            'required' => false,
            'label' => 'Přidat nové pracoviště',
            'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
            'attr' => array(
                'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                'placeholder' => 'Přidat nové pracoviště',
            ),
        ])
    ;
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AssetsManager::class,
        ]);
    }
}