<?php

namespace App\DataFixtures;

use App\Entity\Equipment;
use App\Entity\EquipmentType;
use App\Entity\Game;

use App\Repository\GameRepository;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class EquipmentFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        /**
         * Default equipment types
         */

        $tabequipmenttypes = [];
        $equipmenttypes = [
            'Arme à énergie',
            'Arme à feu',
            'Arme tranchante', 
            "Arme d'estoc", 
            "Arme de taille et d'estoc", 
            'Arme de jet', 
            'Arme de corps à corps', 
            "Arme d'impact", 
            "Arme de Fortune",
            'Arme lourde',
            'Art martiaux',
            'Armure',
            'Artillerie',
            'Bouclier',
            'Lutte',
            'Machine lourde', 
            'Marchandises', 
            'Arme à distance',                              
        ];

        foreach ($equipmenttypes as $key => $value) {
            $equipmenttype = new EquipmentType();
            $equipmenttype->setName($value);
            $manager->persist($equipmenttype);
            $tabequipmenttypes[] = $equipmenttype;
        }

        /**
         * Default equipments
         */

        $equipments = [
            ["Bagarre", 25, "1D3 + MD", 2, 5, 25, 0, 0, $tabequipmenttypes[6]],
            ["Assommoir", 25, "1D8 + 3 + MD", 1, 5, 25, 0, 0, $tabequipmenttypes[6]],
            ["Arc de Chasse", 10, "2D6 + 1 + 1/2 MD", 2, 30, 25, 0, 0, $tabequipmenttypes[5]],
            ["Lance-roquette", 25, "1D3 + MD", 2, 75, 25, 0, 0, $tabequipmenttypes[5]],
            ["Catapulte", 25, "1D3 + MD", 1, 75, 25, 0, 0, $tabequipmenttypes[5]],
            ["Canon", 25, "1D3 + MD", 1, 75, 25, 0, 0, $tabequipmenttypes[5]],
            ["Engin de siège", 25, "1D3 + MD", 0, 75, 25, 0, 0, $tabequipmenttypes[7]],
            ["Pistolet à énergie", 25, "1D3 + MD", 1, 25, 15, 0, 0, $tabequipmenttypes[0]],
            ["Fusil à énergie", 25, "1D3 + MD", 1, 25, 15, 0, 0, $tabequipmenttypes[0]],
            ["Armure de plate", 25, "1D3 + MD", 0, 50, 0, 50, 0, $tabequipmenttypes[11]],
            ["Armure de cuir", 25, "1D3 + MD", 0, 75, 0, 75, 0, $tabequipmenttypes[11]],
            ["Collier", 25, "1D3 + MD", 1, 25, 15, 0, 0, $tabequipmenttypes[16]],
            ["Mortier", 25, "1D3 + MD", 1, 25, 15, 0, 0, $tabequipmenttypes[7]],
            ["Matraque télescopique", 25, "1D3 + MD", 1, 25, 15, 0, 0, $tabequipmenttypes[7]],
        ];

        foreach ($equipments as list($a, $b, $c, $d, $e, $f, $g, $h, $i)) {
            $equipment = new Equipment();
            $equipment->setName($a)
                    ->setBase($b)
                    ->setDamage($c)
                    ->setHands($d)
                    ->setHealth($e)
                    ->setRanged($f)
                    ->setArmorPoints($g)
                    ->setSkillModifyer($h)
                    ->setEquipmentType($i)
                    ->addGame($this->getReference('game1'));
            $manager->persist($equipment);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 13;
    }
}
