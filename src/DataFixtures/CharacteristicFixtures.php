<?php

namespace App\DataFixtures;

use App\Entity\Characteristic;
use App\Entity\GameCharacteristic;
use App\Entity\CharacterCharacteristic;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class CharacteristicFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {   


/* -------------------------------------------------------------------------------------------------------------------------- */        
         /**
         * common characteristics
         */

        $commonCharacteristics = [
            ["Constitution", "CON", 'Type'],
            ["Force", "FOR", 'Type'],
            ["Intelligence", "INT", 'Type'],
            ["Dexterité", "DEX", 'Type'],
        ];

        foreach ($commonCharacteristics as list($a, $b, $c)) {
            $characteristic = new Characteristic();
            $characteristic->setName($a)
                        ->setShortName($b)
                        ->setType($c);
            $tabCharCO[] = $characteristic;
            $tabCharElric[] = $characteristic;
            $manager->persist($characteristic);

            $gameCharacteristic = new GameCharacteristic();
            $gameCharacteristic->setGame($this->getReference('game1'))
                    ->setCharacteristic($characteristic)
                    ->setBase('0');
            $manager->persist( $gameCharacteristic );

            $gameCharacteristic = new GameCharacteristic();
            $gameCharacteristic->setGame($this->getReference('game2'))
                    ->setCharacteristic($characteristic)
                    ->setBase('0');
            $manager->persist( $gameCharacteristic );
        }
            
        
        /**
         * Elric characteristics
         */

        $characteristics = [
            ["Modificateur aux dégâts", "DMG", 'Base'],
            ["Jet d'Idée", "JIDE", 'Base'],
            ["Jet de Chance", "JLUCK", 'Base'],
            ["Jet de Dexterité", "JDEX", 'Base'],
            ["Jet de Charisme", "JCHA", 'Base'],
            ["Taille", "TAI", 'Type'],
            ["Pouvoir", "POU", 'Type'],
            ["Apparence", "APP", 'Type'],
            ["Points de magie", "PM", 'Base'],
            ["Points d'impact", "PI", 'Base'],
        ];

        foreach ($characteristics as list($a, $b, $c)) {
            $characteristic = new Characteristic();
            $characteristic->setName($a)
                        ->setShortName($b)
                        ->setType($c);
            $tabCharElric[] = $characteristic;
            $manager->persist($characteristic);

            $gameCharacteristic = new GameCharacteristic();
            $gameCharacteristic->setGame($this->getReference('game1'))
                    ->setCharacteristic($characteristic)
                    ->setBase('0');
            $manager->persist( $gameCharacteristic );
        }

        /**
         * Elric character characteristics
         */

        $tabgamers = array('character1', 'character2', 'character3', 'character4', 'character5', 'character6');
        $tab1 = array("12", "15", "17", "12", "1d4", null, null, null, null, "13", "14", "16", "11", "28", "29");
        $tab2 = array("16", "13", "15", "18", "1d4", null, null, null, null, "15", "13", "14", "11", "28", "29");
        $tab3 = array("14", "13", "14", "13", "1d4", null, null, null, null, "15", "15", "17", "13", "28", "29");
        $tab4 = array("15", "15", "16", "15", "1d4", null, null, null, null, "14", "13", "13", "13", "28", "29");
        $tab5 = array("14", "13", "15", "15", "1d4", null, null, null, null, "15", "15", "13", "13", "28", "29");
        $tab6 = array("12", "16", "13", "15", "1d4", null, null, null, null, "13", "14", "16", "17", "28", "29");

        $i = 0;
        foreach ($tabgamers as $key)
        {            
            $j = 0;
            foreach ($tabCharElric as $value)
            {
                
                $charactercharacteristic = new CharacterCharacteristic();
                $charactercharacteristic->setCharacter($this->getReference($key));
                $charactercharacteristic->setCharacteristic($value);
        
                switch ($i) {
                    case 0:
                            $charactercharacteristic->setBase($tab1[$j]);
                        break;
                    case 1:
                            $charactercharacteristic->setBase($tab2[$j]);
                        break;
                    case 2:
                            $charactercharacteristic->setBase($tab3[$j]);            
                        break;
                    case 3:
                            $charactercharacteristic->setBase($tab4[$j]); 
                        break;
                    case 4:
                            $charactercharacteristic->setBase($tab5[$j]);
                        break;
                    case 5:
                            $charactercharacteristic->setBase($tab6[$j]); 
                        break;
                }            
                $j++;    

                $manager->persist( $charactercharacteristic );
            }
            $i++;       
        }        

/* -------------------------------------------------------------------------------------------------------------------------- */

        /**
         * Chroniques oubliées characteristics
         */

        $characteristics = [
            ["Perception", "PER", 'Type'],
            ["Charisme", "CHA", 'Type'],
            ["Niveau", "LVL", 'Base'],
            ["Dé de vie", "DDV", 'Base'],
            ["Points de vie", "PV", 'Base'],
            ["Points de choc", "PC", 'Base'],
            ["Défense", "DEF", 'Base'],
            ["Contact", "CNT", 'Attack'],
            ["Distance", "DIS", 'Attack'],
            ["Magique", "MAG", 'Attack'],
            ["Points de folie", "PF", 'Base'],
        ];

        foreach ($characteristics as list($a, $b, $c)) {
            $i = 7;
            $characteristic = new Characteristic();
            $characteristic->setName($a)
                        ->setShortName($b)
                        ->setType($c);
            $tabCharCO[] = $characteristic;
            $manager->persist($characteristic);

            $gameCharacteristic = new GameCharacteristic();
            $gameCharacteristic->setGame($this->getReference('game2'))
                    ->setCharacteristic($characteristic)
                    ->setBase('0');
            $manager->persist( $gameCharacteristic );

        }

        /**
         * CO character characteristics
         */

        $tabgamers = array('character7', 'character8', 'character9', 'character10', 'character11', 'character12');
        $tab1 = array("10", "17", "13", "12", "10", "13", "1", "10", "11", "3", "13", "1", "4", "1", "27");
        $tab2 = array("15", "12", "15", "10", "12", "11", "1", "10", "12", "2", "11", "2", "3", "0", "27");
        $tab3 = array("10", "10", "13", "16", "15", "12", "1", "8", "9", "4", "10", "1", "0", "3", "27");
        $tab4 = array("13", "11", "16", "10", "10", "15", "1", "8", "11", "6", "10", "2", "0", "0", "27");
        $tab5 = array("9", "15", "10", "12", "13", "16", "1", "6", "6", "5", "12", "-1", "2", "1", "27");
        $tab6 = array("10", "12", "11", "17", "14", "11", "1", "6", "6", "2", "11", "0", "1", "3", "27");

        $tab11 = array("0", "3", "1", "1", "0", "1");
        $tab12 = array("2", "1", "2", "0", "1", "0");
        $tab13 = array("0", "0", "1", "3", "2", "0");
        $tab14 = array("1", "0", "3", "0", "0", "2");
        $tab15 = array("-1", "2", "0", "1", "1", "3");
        $tab16 = array("0", "1", "0", "3", "2", "0");

        $i = 0;
        foreach ($tabgamers as $key)
        {            
            $j = 0;
            foreach ($tabCharCO as $value)
            {
                
                $charactercharacteristic = new CharacterCharacteristic();
                $charactercharacteristic->setCharacter($this->getReference($key));
                $charactercharacteristic->setCharacteristic($value);
        
                switch ($i) {
                    case 0:
                            $charactercharacteristic->setBase($tab1[$j]);
                            if ($j<6){
                                $charactercharacteristic->setModifyer($tab11[$j]);
                            } 
                        break;
                    case 1:
                            $charactercharacteristic->setBase($tab2[$j]);
                            if ($j<6){
                                $charactercharacteristic->setModifyer($tab12[$j]);
                            }  
                        break;
                    case 2:
                            $charactercharacteristic->setBase($tab3[$j]); 
                            if ($j<6){
                                $charactercharacteristic->setModifyer($tab13[$j]);
                            }              
                        break;
                    case 3:
                            $charactercharacteristic->setBase($tab4[$j]); 
                            if ($j<6){
                                $charactercharacteristic->setModifyer($tab14[$j]);
                            }   
                        break;
                    case 4:
                            $charactercharacteristic->setBase($tab5[$j]);
                            if ($j<6){
                                $charactercharacteristic->setModifyer($tab15[$j]);
                            }   
                        break;
                    case 5:
                            $charactercharacteristic->setBase($tab6[$j]); 
                            if ($j<6){
                                $charactercharacteristic->setModifyer($tab16[$j]);
                            } 
                        break;
                }            
                $j++;    

                $manager->persist( $charactercharacteristic );
            }
            $i++;       
        }              
        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }
}
