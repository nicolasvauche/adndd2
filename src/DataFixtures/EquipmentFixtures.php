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

        // Equipment Type CO pour séparer les armes des équipements
        $equipmenttype = new EquipmentType();
        $value = 'Arme';
        $equipmenttypes[] = $value;
        $equipmenttype->setName($value);
        $manager->persist($equipmenttype);

        // Armes default Elric

        
        /**
         * CO equipments
         */

        $equipments = [
            ["Pistolet lourd (cal. 45)", 0, "1D10", 0, 0, 0, 0, 0, $equipmenttype, 'character8'],
            ["Fusil à répétition", 0, "1D8", 0, 0, 0, 0, 0, $equipmenttype, 'character8'],
            ["Pistolet moyen (cal. 38)", 0, "1D8", 0, 0, 0, 0, 0, $equipmenttype, 'character10'],
            ["Mini-pistolet (Derringer)", 0, "1D6", 0, 0, 0, 0, 0, $equipmenttype, 'character11'],
            ["Tenue d'aviateur", 0, '', 0, 0, 0, 0, 0, null, 'character7'],
            ["Caisse à outil", 0, '', 0, 0, 0, 0, 0, null, 'character7'],
            ["Biplan d'occasion", 0, '', 0, 0, 0, 0, 0, null, 'character7'],
            ["Uniforme", 0, '', 0, 0, 0, 0, 0, null, 'character8'],
            ["Canne", 0, '', 0, 0, 0, 0, 0, null, 'character8'],
            ["Tenue de randonnée", 0, '', 0, 0, 0, 0, 0, null, 'character9'],
            ["Matériel de fouille", 0, '', 0, 0, 0, 0, 0, null, 'character9'],
            ["Cartes de sites archéologiques", 0, '', 0, 0, 0, 0, 0, null, 'character9'],
            ["Tenue de randonnée", 0, '', 0, 0, 0, 0, 0, null, 'character10'],
            ["Matériel de camping et d’alpinisme", 0, '', 0, 0, 0, 0, 0, null, 'character10'],
            ["Voilier", 0, '', 0, 0, 0, 0, 0, null, 'character10'],
            ["Carnet de notes", 0, '', 0, 0, 0, 0, 0, null, 'character10'],
            ["Carnet de presse", 0, '', 0, 0, 0, 0, 0, null, 'character11'],
            ["Carnet d'adresse", 0, '', 0, 0, 0, 0, 0, null, 'character11'],
            ["Appareil photo à soufflet", 0, '', 0, 0, 0, 0, 0, null, 'character11'],
            ["Tenue de médecin", 0, '', 0, 0, 0, 0, 0, null, 'character12'],       
            ["Trousse de secours", 0, '', 0, 0, 0, 0, 0, null, 'character12'],
            ["Automobile de base", 0, '', 0, 0, 0, 0, 0, null, 'character12'],
        ];

        // Equipment CO simple character
        foreach ($equipments as list($a, $b, $c, $d, $e, $f, $g, $h, $i, $j)) {
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
                    ->addGame($this->getReference('game2'))
                    ->addCharacter($this->getReference($j));
            $manager->persist($equipment);
        } 
                
        // Equipment CO multiple character
        $equipment1 = new Equipment();
        $equipment1->setName("Tenue de citadin")
                ->setBase('0')
                ->setDamage('0')
                ->setHealth('0')
                ->setRanged('0')
                ->addGame($this->getReference('game2'))
                ->setEquipmentType(null);
        for ($z=7; $z<=12; $z++){
            $value = 'character'.$z;
            $equipment1->addCharacter($this->getReference($value));
            $manager->persist($equipment1);
        }

        $equipment2 = new Equipment();
        $equipment2->setName("Berline ordinaire")
                ->setBase('0')
                ->setDamage('0')
                ->setHealth('0')
                ->setRanged('0')
                ->addGame($this->getReference('game2'))
                ->setEquipmentType(null)                
                ->addCharacter($this->getReference('character7'));
        $manager->persist($equipment2);
        $equipment2->addCharacter($this->getReference('character8'));
        $manager->persist($equipment2);

        $manager->flush();
    }

    public function getOrder()
    {
        return 13;
    }
}
