<?php

namespace App\Repository;

use App\Entity\GameSkill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GameSkill|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameSkill|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameSkill[]    findAll()
 * @method GameSkill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameSkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameSkill::class);
    }

    // /**
    //  * @return GameSkill[] Returns an array of GameSkill objects
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
    public function findOneBySomeField($value): ?GameSkill
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
