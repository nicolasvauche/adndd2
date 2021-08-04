<?php

namespace App\Repository;

use App\Entity\GameCharacteristic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GameCharacteristic|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameCharacteristic|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameCharacteristic[]    findAll()
 * @method GameCharacteristic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameCharacteristicRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameCharacteristic::class);
    }

    // /**
    //  * @return GameCharacteristic[] Returns an array of GameCharacteristic objects
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
    public function findOneBySomeField($value): ?GameCharacteristic
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
