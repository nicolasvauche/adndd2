<?php

namespace App\DataFixtures;

use App\Entity\Specialty;
use App\Entity\Game;
use App\Entity\Character;

use App\Repository\GameRepository;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class SpecialtyFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /**
         * Default specialty CO
         */
        $tabspecialties = [];
        $tabspecialties = [
            'Pilote', 
            'Militaire', 
            'Archéologue', 
            'Aventurier', 
            'Journaliste', 
            'Thérapeute', 
        ];
        
        $i = 7;
        foreach ($tabspecialties as &$value) {
            $specialty = new Specialty();
            $specialty->setName($value)
                    ->addGame($this->getReference('game2'))
                    ->addCharacter($this->getReference('character'.$i));
            $manager->persist( $specialty );
            $i++;
        }

        unset($value, $i);

        /**
         * Default specialty Elric
         */        

        $tabspecialtiesElric = [
            'Beggar', 
            'Craftsperson', 
            'Shopkeeper', 
            'Hunter', 
            'Lost', 
            'Forgotten', 
            'Mercenary', 
            'Bodyguard', 
            'Merchant', 
            'Minor Noble', 
            'Nomad', 
            'Paid Assassin', 
            'Thug', 
            'Peasant', 
            'Farmer', 
            'Physician', 
            'Apothecary', 
            'Sailor', 
            'Scribe', 
            'Engineer', 
            'Shaman', 
            'Priest', 
            'Cultist', 
            'Slave (freed or escaped)', 
            'Small Trader', 
            'Soldier', 
            'Guard', 
            'Watchman', 
            'Tax or Rent collector', 
            'Thief', 
            'Troubadour',
            'Entertainer',
        ];
        
        foreach ($tabspecialtiesElric as &$value) {
            $specialty = new Specialty();
            $specialty->setName($value)
                    ->addGame($this->getReference('game1'));
            $manager->persist( $specialty );
        }
        unset($value, $i);        

        $manager->flush();
    }

    public function getOrder()
    {
        return 12;
    }
}
