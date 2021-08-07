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
         * Default specialty
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

        $manager->flush();
    }

    public function getOrder()
    {
        return 12;
    }
}
