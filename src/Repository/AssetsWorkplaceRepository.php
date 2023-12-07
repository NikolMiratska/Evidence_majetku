<?php

namespace App\Repository;

use App\Entity\AssetsWorkplace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AssetsWorkplace>
 *
 * @method AssetsWorkplace|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssetsWorkplace|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssetsWorkplace[]    findAll()
 * @method AssetsWorkplace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssetsWorkplaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssetsWorkplace::class);
    }

//    /**
//     * @return AssetsWorkplace[] Returns an array of AssetsWorkplace objects
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

//    public function findOneBySomeField($value): ?AssetsWorkplace
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
