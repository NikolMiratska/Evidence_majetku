<?php

namespace App\Service;

use App\Entity\AssetsManager;
use App\Repository\AssetsManagerRepository;
use Doctrine\ORM\EntityManagerInterface;

class CategoryGenerator
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function generateCategory($type): string
    {
        $lastNumber = $this->getLastAssignedNumber($type);
        $newNumber = $lastNumber + 1;

        $category = substr($type, 0, 1) . $newNumber;

        $this->updateLastAssignedNumber($type, $newNumber);

        return $category;
    }

    private function getLastAssignedNumber($type): int
    {
        return 100;
    }

    private function updateLastAssignedNumber($type, int $newNumber): void
    {

    }

//    public function generateCategory($type): string
//    {
//        $lastNumber = $this->getLastAssignedNumber($type);
//        $newNumber = $lastNumber + 1;
//
//        $category = strtoupper(substr($type, 0, 1)) . $newNumber;
//
//        $this->updateLastAssignedNumber($type, $newNumber);
//
//        return $category;
//    }
//
//    private function getLastAssignedNumber($type): int
//    {
//        return $this->entityManager
//            ->getRepository(AssetsManager::class)
//            ->getLastAssignedNumberForType($type);
//    }
//
//    private function updateLastAssignedNumber($type, int $newNumber): void
//    {
//        $this->entityManager
//            ->getRepository(AssetsManager::class)
//            ->updateLastAssignedNumberForType($type, $newNumber);
//    }


//    public function generateCategory($type): string
//    {
//        $lastNumber = $this->getLastAssignedNumber($type);
//        $newNumber = $lastNumber + 1;
//
//        $category = strtoupper(substr($type, 0, 1)) . $newNumber;
//
//        $this->updateLastAssignedNumber($type, $newNumber);
//
//        return $category;
//    }
//
//    private function getLastAssignedNumber($type): int
//    {
//        return $this->getYourEntityRepository()->getLastAssignedNumberForType($type);
//    }
//
//    private function updateLastAssignedNumber($type, int $newNumber): void
//    {
//        $this->getYourEntityRepository()->updateLastAssignedNumberForType($type, $newNumber);
//    }
//
//    private function getYourEntityRepository(): AssetsManagerRepository
//    {
//        return $this->entityManager->getRepository(AssetsManager::class);
//    }
}
