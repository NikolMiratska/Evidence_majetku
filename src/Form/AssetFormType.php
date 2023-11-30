<?php

namespace App\Form;

use App\Entity\AssetsManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
                'label' => 'Název majetku',
            ])
            ->add('inventoryNumber', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Inventární číslo',
                ),
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
                'label' => 'Inventární číslo',
            ])
            ->add('description', TextareaType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Popis',
                ),
                'label' => 'Popis',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
                'required' => false,
            ])
            ->add('unitPrice', IntegerType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Cena',
                ),
                'label' => 'Cena',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
            ])
            ->add('supplier', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Dodavatel',
                ),
                'label' => 'Dodavatel',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
                'required' => false,
            ])
            ->add('manufacturer', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Výrobce',
                ),
                'label' => 'Výrobce',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
                'required' => false,
            ])
            ->add('guaranteePeriod', IntegerType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Záruční doba (roky)',
                ),
                'label' => 'Záruční doba (roky)',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
            ])
            ->add('assetType', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Druh',
                ),
                'label' => 'Druh (židle, stůl,..)',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
                'required' => false,
            ])
            ->add('subsumptionDate', DateType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                ),
                'label' => 'Datum zařazení',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
                'required' => false,
            ])
            ->add('eliminationDate', DateType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                ),
                'label' => 'Datum vyřazení',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
                'required' => false,
            ])
            ->add('assetLocation', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Umístění',
                ),
                'label' => 'Umístění majetku ve firmě',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
                'required' => false,
            ])
            //TODO
            ->add('assignedPerson', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Přizeno (člověku)',
                ),
                'label' => 'Přizeno (člověku)',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
                'required' => false,
            ])
//            ->add('assignedPerson', EntityType::class, [
//                'class' => 'App\Entity\User',
//                'choice_label' => 'email',
//                'attr' => array(
//                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
//                    'placeholder' => 'Přizeno (člověku)',
//                ),
//                'label' => 'Přizeno (člověku)',
//                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
//                'required' => false,
//            ])
            ->add('manufacturingNumber', IntegerType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Výrobní číslo',
                ),
                'label' => 'Výrobní číslo',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
                'required' => false,
            ])
            ->add('dateCreated', DateType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                ),
                'label' => 'Datum vytvoření',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
            ])
            ->add('note', TextareaType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Poznámky',
                ),
                'label' => 'Poznámky',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
                'required' => false,
            ])
            ->add('documentPath', FileType::class, array(
                'required' => false,
                'mapped' => false,
                'label' => 'Dokumenty',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
            ))
            ->add('dateBought', DateType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                ),
                'required' => false,
                'label' => 'Datum zakoupení',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
            ])
            ->add('dateReceived', DateType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                ),
                'required' => false,
                'label' => 'Datum obdržení',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
            ])
            ->add('eliminated', ChoiceType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Poznámky',
                ),
                'label' => 'Vyřezeno',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
                'choices'  => [
                    '' => null,
                    'Ano' => true,
                    'Ne' => false,
                ],
            ])
            ->add('owner', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Vlastník',
                ),
                'label' => 'Vlastník',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
                'required' => false,
            ])
            ->add('category', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Kategorie (motorový, elektrický,..)',
                ),
                'label' => 'Kategorie',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
                'required' => false,
            ])->add('workplace', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Pracoviště',
                ),
                'label' => 'Pracoviště',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
                'required' => false,
            ])
            ->add('complaint', TextareaType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Popis reklamace',
                ),
                'label' => 'Reklamace',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
                'required' => false,
            ])
            ->add('nextServiceDue', DateType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                ),
                'required' => false,
                'label' => 'Příští servis',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
            ])
            ->add('serviceInterval', TextareaType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Servisní interval',
                ),
                'label' => 'Servisní interval',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-sm'],
                'required' => false,
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
