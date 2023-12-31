<?php

namespace App\Repository;

use App\Entity\AssetsManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AssetsManager>
 *
 * @method AssetsManager|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssetsManager|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssetsManager[]    findAll()
 * @method AssetsManager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssetsManagerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssetsManager::class);
    }

//    /**
//     * @return AssetsManager[] Returns an array of AssetsManager objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AssetsManager
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
