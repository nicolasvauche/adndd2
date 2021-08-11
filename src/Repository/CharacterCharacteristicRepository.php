<?php

namespace App\Repository;

use App\Entity\CharacterCharacteristic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CharacterCharacteristic|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharacterCharacteristic|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharacterCharacteristic[]    findAll()
 * @method CharacterCharacteristic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacterCharacteristicRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CharacterCharacteristic::class);
    }

    // /**
    //  * @return CharacterCharacteristic[] Returns an array of CharacterCharacteristic objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CharacterCharacteristic
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
