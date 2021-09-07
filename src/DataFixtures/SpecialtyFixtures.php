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
            ['Beggar', '01-02', '01-05'],
            ['Craftsperson', '03-06', '06-10'],
            ['Shopkeeper', '03-06', '06-10'],
            ['Hunter', '07-10', '11-15'],
            ['Lost', '11', '16-20'],
            ['Forgotten', '11', '16-20'],
            ['Mercenary', '12', '21-25'],
            ['Bodyguard', '12', '21-25'],
            ['Merchant', '13', '26-30'],
            ['Minor Noble', '14', '31-35'],
            ['Nomad', '15', '36-40'],
            ['Paid Assassin', '16', '41-45'], 
            ['Thug', '16', '41-45'],
            ['Peasant', '17-76', '46-50'],
            ['Farmer', '17-76', '46-50'],
            ['Physician', '77', '51-55'],
            ['Apothecary', '77', '51-55'],
            ['Sailor', '78-80', '56-60'],
            ['Scribe', '81', '61-65'],
            ['Engineer', '81', '61-65'],
            ['Shaman', '82', '66-70'],
            ['Priest', '82', '66-70'],
            ['Cultist', '82', '66-70'],
            ['Slave (freed or escaped)', '83-88', '71-75'],
            ['Small Trader', '89-91', '76-80'],
            ['Soldier', '92-97', '81-85'],
            ['Guard', '92-97', '81-85'],
            ['Watchman', '92-97', '81-85'],
            ['Tax or Rent collector', '98', '86-90'],
            ['Thief', '99', '91-95'],
            ['Troubadour', '00', '96-00'],
            ['Entertainer', '00', '96-00'],
        ];
        
        foreach ($tabspecialtiesElric as list($name, $relative, $straightline)) {
            $specialty = new Specialty();
            $specialty->setName($name)
                    ->setRelative($relative)
                    ->setStraightline($straightline)
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
