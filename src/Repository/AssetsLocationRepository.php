<?php

namespace App\Repository;

use App\Entity\AssetsLocation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AssetsLocation>
 *
 * @method AssetsLocation|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssetsLocation|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssetsLocation[]    findAll()
 * @method AssetsLocation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssetsLocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssetsLocation::class);
    }

//    /**
//     * @return AssetsLocation[] Returns an array of AssetsLocation objects
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

//    public function findOneBySomeField($value): ?AssetsLocation
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
