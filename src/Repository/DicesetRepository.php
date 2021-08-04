<?php

namespace App\Repository;

use App\Entity\Diceset;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Diceset|null find($id, $lockMode = null, $lockVersion = null)
 * @method Diceset|null findOneBy(array $criteria, array $orderBy = null)
 * @method Diceset[]    findAll()
 * @method Diceset[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DicesetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Diceset::class);
    }

    // /**
    //  * @return Diceset[] Returns an array of Diceset objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Diceset
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
