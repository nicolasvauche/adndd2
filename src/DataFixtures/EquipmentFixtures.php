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
         * Elric equipment types
         */

        $tabequipmenttypes = [];
        $equipmenttypes = [
            'Arme tranchante', 
            "Arme d'estoc", 
            "Arme de taille et d'estoc", 
            'Arme de jet', 
            'Arme de corps à corps', 
            "Arme d'impact",                            
            "Arme de fortune", 
            "Bouclier", 
            "Armure",                          
        ];

        foreach ($equipmenttypes as $key => $value) {
            $equipmenttype = new EquipmentType();
            $equipmenttype->setName($value);
            $manager->persist($equipmenttype);
            $tabequipmenttypes[] = $equipmenttype;
        }

        // Equipment Type CO pour séparer les armes des équipements
        $equipmenttype = new EquipmentType();
        $value = 'Arme';
        $equipmenttypes[] = $value;
        $equipmenttype->setName($value);
        $manager->persist($equipmenttype);

/**
 * --------------------------------------------------------------------------------------------------------------------------------
 * ---------------------------------------------------------------------------------------------------------------------------------
 * --------------------------------------------------------------------------------------------------------------------------------
*/
        // Armes Elric (Arme de contact + Arme de fortune + Bouclier)

        $elricEquipments = [
            ["Bagarre", 25, "1D3 + MD", 1, "", false, false, "", "", 0, $tabequipmenttypes[4], "courte"],
            ["Bâton de combat", 25, "1D8 + MD", 2, "20", false, true, "9", "9", 50, $tabequipmenttypes[5], "toutes"],
            ["Cestus", 25, "1D3 + 2 + MD", 1, "10", false, true, "11", "7", 200, $tabequipmenttypes[5], "courte"],
            ["Cimeterre", 15, "1D8 + 1 + MD", 1, "19", true, true, "8", "8", 225, $tabequipmenttypes[2],"moyenne"],
            ["Dague", 25, "1D4 + 2 + MD", 1, "15", true, true, "4", "4", 100, $tabequipmenttypes[2], "courte"],
            ["Poignard", 25, "1D4 + 2 + MD", 1, "15", true, true, "4", "4", 100, $tabequipmenttypes[4], "courte"],
            ["Epée courte", 15, "1D6 + 1 + MD", 1, "20", true, true, "5", "5", 125, $tabequipmenttypes[2], "moyenne"],
            ["Epée large", 15, "1D8 + 1 + MD", 1, "20", true, true, "9", "7", 250, $tabequipmenttypes[0],"moyenne"],
            ["Epée longue", 05, "2D8 + MD", 2, "18", true, true, "14", "13", 750, $tabequipmenttypes[0], "toutes"],
            ["Faucheur", 15, "1D6 + 2 + MD", 1, "18", true, true, "8", "8", 230, $tabequipmenttypes[5], "moyenne"],
            ["Fléau Morningstar", 10, "1D10 + 1 + MD", 2, "12", false, false, "11", "7", 300, $tabequipmenttypes[5], "moyenne"],
            ["Gourdin de voleur", 25, "1D8 + MD", 1, "10", false, false, "7", "7", 0, $tabequipmenttypes[5], "courte"],
            ["Grand marteau", 25, "1D10 + 3 + MD", 2, "15", true, true, "9", "9", 250, $tabequipmenttypes[5], "longue"],
            ["Griffes de fer", 25, "1D4 + 1 + MD", 1, "10", false, true, "9", "9", 45, $tabequipmenttypes[5], "courte"],
            ["Hache d'armes", 15, "1D8 + 2 + MD", 1, "15", true, true, "9", "9", 200, $tabequipmenttypes[0], "moyenne"],
            ["Hache lormyrienne", 15, "3D6 + MD", 2, "25", true, true, "13", "9", 400, $tabequipmenttypes[0], "longue"],
            ["Hache maritime", 15, "2D6 + 2 + MD", 2, "15", true, true, "11", "9", 45, $tabequipmenttypes[0], "moyenne"],
            ["Lance courte", 15, "1D6 + 1 + MD", 3, "15", true, true, "7", "8", 50, $tabequipmenttypes[1], "longue"],
            ["Lance de cavalerie", 15, "1D8 + 1 + MD", 1, "15", true, true, "9", "8", 175, $tabequipmenttypes[1], "longue"],
            ["Lance longue", 15, "1D10 + 1 + MD", 2, "15", true, false, "11", "9", 100, $tabequipmenttypes[1], "longue"],
            ["Lutte", 25, "Spécial", 2, "", false, false, "", "", 0, $tabequipmenttypes[4], "courte"],
            ["Marteau de guerre", 25, "1D6 + 2 + MD", 1, "20", true, true, "11", "9", 200, $tabequipmenttypes[5], "moyenne"],
            ["Masse légère", 25, "1D6 + 2 + MD", 1, "20", false, true, "7", "7", 75, $tabequipmenttypes[5], "moyenne"],
            ["Masse lourde", 25, "1D8 + 2 + MD", 2, "20", false, true, "14", "9", 200, $tabequipmenttypes[5], "moyenne"],
            ["Pique Filkharienne", 15, "1D10 + 2 + MD", 2, "15", true, true, "11", "7", 150, $tabequipmenttypes[1], "longue"],
            ["Rapière", 15, "1D6 + 1 + MD", 1, "15", true, true, "7", "13", 400, $tabequipmenttypes[5], "moyenne"],
            ["Sabre d'abordage", 15, "1D6 + 2 + MD", 1, "21", true, true, "8", "8", 175, $tabequipmenttypes[5], "moyenne"],
            ["Trident", 15, "1D6 + 2 + MD", 3, "18", true, true, "10", "12", 100, $tabequipmenttypes[1], "moyenne"],
            ["Assommoir", 25, "1D8 + 3 + MD", 2, "20", false, false, "13", "7", 12, $tabequipmenttypes[6], "moyenne"],
            ["Bâton", 25, "1D6 + 1 + MD", 2, "15", false, false, "8", "6", 0, $tabequipmenttypes[6], "longue"],
            ["Houlette", 25, "1D6 + 1 + MD", 2, "15", false, false, "8", "6", 0, $tabequipmenttypes[6], "longue"],
            ["Chaîne", 10, "1D4 + MD / enchevêtrement", 3, "20", false, false, "8", "9", 10, $tabequipmenttypes[6], "longue"],
            ["Couteau", 25, "1D6 + MD", 1, "12", true, true, "5", "5", 15, $tabequipmenttypes[6],"courte"],
            ["Cognée", 15, "1D8 + 2 + MD", 2, "20", true, false, "8", "7", 20, $tabequipmenttypes[6], "moyenne"],
            ["Faucille", 10, "1D6 + 1 + MD", 1, "12", true, false, "7", "9", 15, $tabequipmenttypes[6], "courte"],
            ["Faux", 05, "2D6 + 1 + MD", 2, "20", true, false, "12", "10", 35, $tabequipmenttypes[6], "longue"],
            ["Fléau à grain", 10, "1D6 + MD", 1, "7", false, false, "7", "6", 5, $tabequipmenttypes[6], "moyenne"],
            ["Fouet", 05, "1D3 - 1 / enchevêtrement", 1, "4", false, false, "9", "10", 10, $tabequipmenttypes[6], "longue"],
            ["Garot", 15, "strangulation", 2, "1", false, false, "8", "12", 0, $tabequipmenttypes[6], "courte"],
            ["Gourdin", 25, "1D8 + MD", 2, "22", false, false, "9", "7", 0, $tabequipmenttypes[6], "moyenne"],
            ["Hachette", 15, "1D6 + 1 + MD", 1, "12", true, false, "7", "9", 15, $tabequipmenttypes[6], "courte"],
            ["Petit couteau", 25, "1D4 + MD", 1, "9", true, false, "4", "3", 10, $tabequipmenttypes[6], "courte"],
            ["Trique", 25, "1D6 + MD", 1, "15", false, false, "7", "7", 20, $tabequipmenttypes[6], "moyenne"],
            ["Tisonnier", 25, "1D6 + 1 + MD", 1, "20", false, true, "10", "6", 7, $tabequipmenttypes[6], "moyenne"],
            ["Torche allumée", 10, "1D6 flamme", 1, "15", false, false, "6", "9", 0, $tabequipmenttypes[6], "moyenne"], 

            ["Demi", 15, "Repousser + 1D2 + MD", 0, "15", false, true, "5", "7", 75, $tabequipmenttypes[7], null], 
            ["Petit", 15, "Repousser + 1D3 + MD", 0, "20", false, true, "9", "9", 100, $tabequipmenttypes[7], null],
            ["Entier", 15, "Repousser + 1D4 + MD", 0, "22", false, true, "11", "9", 125, $tabequipmenttypes[7], null],
            ["Grand", 15, "Repousser", 0, "26", false, true, "12", "8", 150, $tabequipmenttypes[7], null],
        ];

        foreach ($elricEquipments as list($name, $base, $degat, $main, $structure, $empale, $pare, $fordex, $dexdex, $prix, $equiptype, $taille)) {
            $equipment = new Equipment();
            $equipment->setName($name)
                    ->setBase($base)
                    ->setDamage($degat)
                    ->setHands($main)
                    ->setHealth('0')
                    ->setRanged('0')
                    ->setStructure($structure)
                    ->setImpale($empale)
                    ->setWard($pare)
                    ->setFordex($fordex)
                    ->setDexdex($dexdex)
                    ->setPrice($prix)
                    ->addGame($this->getReference('game1'))
                    ->setEquipmentType($equiptype)
                    ->setSize($taille);
            $manager->persist($equipment);
        } 

        // Armes Elric ( Arme de jet)

        $elricArmeJet = [
            ["Arc de Mélniboné", 10, "2D6 + 1 + 1/2 MD", 200, 12, true, false, "11", "13", 750, $tabequipmenttypes[3], "1"],
            ["Arc de Chasse", 10, "1D6 + 1 + 1/2 MD", 80, 6, true, false, "9", "9", 150, $tabequipmenttypes[3], "1"],
            ["Arc du désert", 10, "1D8 + 2 + 1/2 MD", 100, 10, true, false, "13", "11", 250, $tabequipmenttypes[3], "1"],
            ["Dague de Lancer", 15, "1D4 + 1/2 MD", 10, 12, true, false, "7", "11", 100, $tabequipmenttypes[3], "1"],
            ["Filet", 05, "enchevêtrement", 5, 6, false, true, "9", "12", 25, $tabequipmenttypes[3], "1"],
            ["Fronde", 01, "1D8 + 1/2 MD", 80, 0, true, false, "7", "11", 15, $tabequipmenttypes[3], "1"],
            ["Hache de Lancer", 10, "1D6 + 1/2 MD", 20, 15, true, false, "9", "11", 150, $tabequipmenttypes[3], "1"],
            ["Harpon", 05, "2D8 + 4 + 1/2 MD", 10, 20, true, false, "13", "11", 250, $tabequipmenttypes[3], "1"],
            ["Javelot", 15, "1D6 + 1/2 MD", 15, 10, true, false, "9", "9", 75, $tabequipmenttypes[3], "1"],
            ["Lance 1M Lancée", 05, "1D6 + 1 + 1/2 MD", 15, 15, true, false, "12", "10", 200, $tabequipmenttypes[3], "1"],
            ["Lance 2M Lancée", 05, "1D6 + 1 + 1/2 MD", 15, 15, true, false, "12", "10", 200, $tabequipmenttypes[3], "1"],
            ["Lance-pierres", 05, "1D10 + 1/2 MD", 100, 10, true, false, "9", "11", 60, $tabequipmenttypes[3], "1"],
            ["Pierre Lancée (% Lancer)", 0, "1D2 + 1/2 MD", 20, 20, false, false, "5", "5", 0, $tabequipmenttypes[3], "2"],
        ];

        foreach ($elricArmeJet as list($name, $base, $degat, $portee, $structure, $empale, $pare, $fordex, $dexdex, $prix, $equiptype, $tour)) {
            $equipment = new Equipment();
            $equipment->setName($name)
                    ->setBase($base)
                    ->setDamage($degat)
                    ->setHealth('0')
                    ->setRanged($portee)
                    ->setStructure($structure)
                    ->setImpale($empale)
                    ->setWard($pare)
                    ->setFordex($fordex)
                    ->setDexdex($dexdex)
                    ->setPrice($prix)
                    ->setNumberRound($tour)
                    ->addGame($this->getReference('game1'))
                    ->setEquipmentType($equiptype);
            $manager->persist($equipment);
        } 

        // Armes Elric ( Armure)

        $elricArmure = [
            ["Cuir et anneaux", "1D6 + 1", "1D6", "léger", "+/- 1", "25", "10", 2, 600, $tabequipmenttypes[8]],
            ["Cuir et bois barbares", "1D8", "1D6", "léger", "non", "25", "10", 2, 400, $tabequipmenttypes[8]],
            ["Cuir maritime", "1D6", "1D6 - 1", "léger", "non", "10", "-", 2, 300, $tabequipmenttypes[8]],
            ["Cuir souple", "1D6 - 1", "1D6 - 1", "léger", "+/- 2", "-", "-", 2, 100, $tabequipmenttypes[8]],
            ["Demi-plaques (torse)", "1D8 + 1", "1D8", "modéré", "+/- 1", "25", "10", 2, 675, $tabequipmenttypes[8]],
            ["Demi-plaques et anneaux", "1D8 + 2", "1D8 + 1", "modéré", "+/- 1", "25", "25", 4, 750, $tabequipmenttypes[8]],
            ["Plaques", "1D10 + 2", "1D10", "encombrant", "- 1", "50", "25", 5, 1000, $tabequipmenttypes[8]],
            ["Plaques Melniboné", "1D10 + 6", "1D10 + 4", "modéré", "non", "25", "10", 5, null, $tabequipmenttypes[8]],
            ["Plaques Pan Tang", "2D8 + 1", "2D8", "encombrant", "+/- 2", "50", "25", 5, 3000, $tabequipmenttypes[8]],      
        ];

        foreach ($elricArmure as list($name, $degat, $degatsansheaume, $encombrement, $taille, $skillmodif, $skillmodifsansheaume, $tour, $prix, $equiptype)) {
            $equipment = new Equipment();
            $equipment->setName($name)
                    ->setDamage($degat)
                    ->setBase('0')
                    ->setHealth('0')
                    ->setRanged('0')
                    ->setSize($taille)
                    ->setSkillModifyer($skillmodif)
                    ->setNumberRound($tour)
                    ->setPrice($prix)
                    ->setClutter($encombrement)
                    ->setDamageNoPowerup($degatsansheaume)
                    ->setSkillModifyerNoPowerup($skillmodifsansheaume)
                    ->addGame($this->getReference('game1'))
                    ->setEquipmentType($equiptype);
            $manager->persist($equipment);
        } 
/**
 * --------------------------------------------------------------------------------------------------------------------------------
 * ---------------------------------------------------------------------------------------------------------------------------------
 * --------------------------------------------------------------------------------------------------------------------------------

         * CO equipments
         */

        $equipments = [
            ["Pistolet lourd (cal. 45)", 0, "1D10", 0, 0, 0, null, null, $equipmenttype, 'character8'],
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
        foreach ($equipments as list($name, $base, $damage, $hand, $health, $portee, $armorpoint, $skillmodif, $equiptype, $charact)) {
            $equipment = new Equipment();
            $equipment->setName($name)
                    ->setBase($base)
                    ->setDamage($damage)
                    ->setHands($hand)
                    ->setHealth($health)
                    ->setRanged($portee)
                    ->setArmorPoints($armorpoint)
                    ->setSkillModifyer($skillmodif)
                    ->setEquipmentType($equiptype)
                    ->addGame($this->getReference('game2'))
                    ->addCharacter($this->getReference($charact));
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
