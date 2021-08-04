<?php

namespace App\DataFixtures;

use App\Entity\Tribe;
use App\Entity\Game;

use App\Repository\GameRepository;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class TribeFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /**
         * Default tribe
         */
        $tabtribe = [];
        $tabtribe = [
            "Humain",
            "Melnibonéen", 
            "Myrrhynien", 
            "Elfe", 
            "Nain", 
            "Semi-homme", 
            "Gnome", 
            "Demi-orc", 
            "Vampire", 
            "Loup-garou", 
            "Fantôme", 
            "Changelin", 
            "Exalté"
        ];
        
        foreach ($tabtribe as &$value)
        {
            $tribe = new Tribe();
            $tribe->setName($value);
            $tribe->addGame($this->getReference('game1'));
            $manager->persist( $tribe );
        }
        unset($value);

        $manager->flush();
    }

    public function getOrder()
    {
        return 11;
    }
}
