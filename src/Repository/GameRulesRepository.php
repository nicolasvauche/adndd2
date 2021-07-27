<?php

namespace App\Repository;

use App\Entity\GameRules;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GameRules|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameRules|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameRules[]    findAll()
 * @method GameRules[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRulesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameRules::class);
    }

    // /**
    //  * @return GameRules[] Returns an array of GameRules objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GameRules
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
