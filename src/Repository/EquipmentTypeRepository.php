<?php

namespace App\Repository;

use App\Entity\EquipmentType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EquipmentType|null find($id, $lockMode = null, $lockVersion = null)
 * @method EquipmentType|null findOneBy(array $criteria, array $orderBy = null)
 * @method EquipmentType[]    findAll()
 * @method EquipmentType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipmentTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EquipmentType::class);
    }


    public function findAllByGame ($gameId){
        $conn = $this->getEntityManager()
        ->getConnection();

        $sql = '
        SELECT equipment_type.*
        FROM equipment_type, equipment, game_equipment
        WHERE game_equipment.game_id = ' . $gameId . '
        AND equipment_type.id = equipment.equipment_type_id
        AND equipment.id = game_equipment.equipment_id
        GROUP BY equipment_type.id';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    // /**
    //  * @return EquipmentType[] Returns an array of EquipmentType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EquipmentType
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
