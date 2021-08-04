<?php

namespace App\DataFixtures;

use App\Entity\Specialty;
use App\Entity\Game;

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
            'Cuisinier', 
            'Bûcheron', 
            'Policier', 
            'Archer', 
            'Chevalier', 
            'Artilleur', 
            'Commerçant', 
            "En recherche d'emploi", 
            'Ninja', 
            'Sumotori', 
            'Yakuza', 
            'Lancier', 
            'Pompier', 
            'Mitrailleur',
            'Arbalétrier',
            'Cowboy',
            'Agriculteur',
            'Mousquetaire',
            'Marin'
        ];
  
        foreach ($tabspecialties as &$value) {
        $specialty = new Specialty();
        $specialty->setName($value);
        $specialty->addGame($this->getReference('game1'));
        $manager->persist( $specialty );
        }
        unset($value);

        $manager->flush();
    }

    public function getOrder()
    {
        return 12;
    }
}
