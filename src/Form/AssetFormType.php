<?php

namespace App\Form;

use App\Entity\AssetsManager;
use App\Entity\User;
use Cassandra\Type\UserType;
use Doctrine\ORM\EntityManagerInterface;
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
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
                'label' => 'Název majetku *',
            ])
            ->add('inventoryNumber', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Inventární číslo',
                ),
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
                'label' => 'Inventární číslo *',
            ])
            ->add('description', TextareaType::class, [
                'attr' => array(
                    'class' => ' block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Popis',
                ),
                'label' => 'Popis',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
                'required' => false,
            ])
            ->add('unitPrice', IntegerType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Cena',
                ),
                'label' => 'Cena CZK *',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
            ])
            ->add('supplier', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Dodavatel',
                ),
                'label' => 'Dodavatel',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
                'required' => false,
            ])
            ->add('manufacturer', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Výrobce',
                ),
                'label' => 'Výrobce',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
                'required' => false,
            ])
            ->add('orderNumber', IntegerType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Číslo objednávky',
                ),
                'label' => 'Číslo objednávky',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
                'required' => false,
            ])
            ->add('orderURL', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'URL odjednávky',
                ),
                'label' => 'URL odjednávky',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
                'required' => false,
            ])
            ->add('guaranteePeriod', IntegerType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Záruční doba (roky)',
                ),
                'label' => 'Záruční doba (roky) *',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
            ])
            ->add('assetType', TextType::class, [
//                'class' => 'App\Entity\AssetsManager',
//                'choice_label' => 'assetType',
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Druh',
                ),
                'label' => 'Druh (židle, stůl,..)',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
                'required' => false,
            ])
            ->add('assetLocation', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Umístění',
                ),
                'label' => 'Umístění majetku ve firmě',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
                'required' => false,
            ])
            ->add('ownedBy', EntityType::class, [
                'class' => User::class,
                'choice_label' => fn(User $u) => $u->getEmail(),
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Přizeno (člověku)',
                ),
                'label' => 'Přizeno (člověku)',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
                'required' => false,
            ])
            ->add('newOwner', TextType::class, [
//                'class' => User::class,
                'mapped' => false,
                'required' => false,
            ])
            ->add('manufacturingNumber', IntegerType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Výrobní číslo',
                ),
                'label' => 'Výrobní číslo',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
                'required' => false,
            ])
            ->add('note', TextareaType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Poznámky',
                ),
                'label' => 'Poznámky',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
                'required' => false,
            ])
            ->add('eliminated', ChoiceType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Poznámky',
                ),
                'label' => 'Vyřazeno *',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
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
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
                'required' => false,
            ])
            ->add('category', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Kategorie (motorový, elektrický,..)',
                ),
                'label' => 'Kategorie',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
                'required' => false,
            ])
            ->add('workplace', TextType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Pracoviště',
                ),
                'label' => 'Pracoviště',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
                'required' => false,
            ])
            ->add('complaint', TextareaType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Popis reklamace',
                ),
                'label' => 'Reklamace',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
                'required' => false,
            ])
            ->add('dateCreated', DateType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                ),
                'label' => 'Datum vytvoření *',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
            ])
            ->add('dateBought', DateType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                ),
                'required' => false,
                'label' => 'Datum zakoupení',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
            ])
            ->add('dateReceived', DateType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                ),
                'required' => false,
                'label' => 'Datum obdržení',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
            ])
            ->add('subsumptionDate', DateType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'type' => 'text'
                ),
                'label' => 'Datum zařazení',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
                'required' => false,
            ])
            ->add('eliminationDate', DateType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                ),
                'label' => 'Datum vyřazení',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
                'required' => false,
            ])
            ->add('nextServiceDue', DateType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                ),
                'required' => false,
                'label' => 'Příští servis',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
            ])
            ->add('serviceInterval', TextareaType::class, [
                'attr' => array(
                    'class' => 'block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
                    'placeholder' => 'Servisní interval',
                ),
                'label' => 'Servisní interval',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
                'required' => false,
            ])
            ->add('documentPath', FileType::class, array(
                'attr' => array(
                    'class' => 'px-3 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple'
                ),
                'required' => false,
                'mapped' => false,
                'label' => 'Dokumenty',
                'label_attr' => ['class' => 'text-gray-700 dark:text-gray-400 block text-xl'],
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AssetsManager::class,
        ]);
    }
}
