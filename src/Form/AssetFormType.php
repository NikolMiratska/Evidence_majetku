<?php

namespace App\Form;

use App\Entity\AssetsManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssetFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Název',
                ),
                'label' => false
            ])
            ->add('inventoryNumber', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Inventární číslo',
                ),
                'label' => false
            ])
            ->add('description', TextareaType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Popis',
                ),
                'label' => false
            ])
            ->add('unitPrice', IntegerType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Cena',
                ),
                'label' => false
            ])
            ->add('supplier', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Dodavatel',
                ),
                'label' => false
            ])
            ->add('manufacturer', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Výrobce',
                ),
                'label' => false
            ])
            ->add('guaranteePeriod', IntegerType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Záruční doba (roky)',
                ),
                'label' => false
            ])
            ->add('assetType', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Druh',
                ),
                'label' => false
            ])
            ->add('subsumptionDate', DateType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                ),
                'label' => false
            ])
            ->add('eliminationDate', DateType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                ),
                'label' => false
            ])
            ->add('assetLocation', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Umístění',
                ),
                'label' => false
            ])
            ->add('assignedPerson', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Přizeno (člověku)',
                ),
                'label' => false
            ])
            ->add('manufacturingNumber', IntegerType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Výrobní číslo',
                ),
                'label' => false
            ])
            ->add('dateCreated', DateType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                ),
                'label' => false
            ])
            ->add('note', TextareaType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Poznámky',
                ),
                'label' => false
            ])
            ->add('documentPath', FileType::class, array(
                'required' => false,
                'mapped' => false,
                'label' => false,
            ))
//            ->add('documentPath', FileType::class, [
//                'attr' => array(
//                    'class' => 'py-10'
//                ),
//                'label' => false
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AssetsManager::class,
        ]);
    }
}
