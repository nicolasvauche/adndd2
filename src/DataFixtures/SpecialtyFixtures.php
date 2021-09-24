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
            ['Artisan', '01-04', '01-05'],
            ['Commerçant', '01-04', '01-05'],
            ['Chaman', '05', '06-10'],
            ['Prêtre', '05', '06-10'],
            ["Membre d'un culte", '05', '06-10'],
            ['Chasseur', '06-09', '11-15'],
            ["Collecteur d'impôts ou de loyers", '10', '16-20'],
            ['Esclave (affranchi ou évadé)', '11-16', '21-25'],
            ['Marchand', '17', '26-30'],
            ['Marin', '18-20', '31-35'],
            ['Médecin', '21', '36-40'],
            ['Apothicaire', '21', '36-40'], 
            ['Mendiant', '22-23', '41-45'],
            ['Mercenaire', '24', '46-50'],
            ['Garde du corps', '24', '46-50'],
            ['Nomade', '25', '51-55'],
            ['Paysan', '26-85', '56-60'],
            ['Fermier', '26-85', '56-60'],
            ['Perdu', '86', '61-65'],
            ['Oublié', '86', '61-65'],
            ['Petit négociant', '87-89', '66-70'],
            ['Petite noblesse', '90', '71-75'],
            ['Scribe', '91', '76-80'],
            ['Ingénieur', '91', '76-80'],
            ['Soldat', '92-97', '81-85'],
            ['Garde', '92-97', '81-85'],
            ['Gardien', '92-97', '81-85'],
            ['Troubadour', '98', '86-90'],
            ['Artiste', '98', '86-90'],
            ['Tueur à gages', '99', '91-95'],
            ['Brigand', '99', '91-95'],
            ['Voleur', '00', '96-00'],
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
