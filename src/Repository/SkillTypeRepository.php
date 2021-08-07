<?php

namespace App\Repository;

use App\Entity\SkillType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SkillType|null find($id, $lockMode = null, $lockVersion = null)
 * @method SkillType|null findOneBy(array $criteria, array $orderBy = null)
 * @method SkillType[]    findAll()
 * @method SkillType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkillTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SkillType::class);
    }

    // /**
    //  * @return SkillType[] Returns an array of SkillType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SkillType
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
