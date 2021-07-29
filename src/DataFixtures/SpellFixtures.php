<?php

namespace App\DataFixtures;

use App\Entity\Spell;
use App\Entity\SpellType;
use App\Entity\Game;

use App\Repository\GameRepository;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class SpellFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        /**
         * Default spell types
         */
        $tabSpellTypes = [];

        $spelltypes = [
            "Sorts de Combat",
            "Sorts d'Action",
            "Sorts de l'Être",
            "Sorts du Monde Invisible",
            "Sorts de Caractéristique",
            "Sorts des Éléments",
            "Sorts d'Intensification",
        ];

        foreach ($spelltypes as $key => $value) {
            $spelltype = new SpellType();
            $spelltype->setName($value);
            $manager->persist($spelltype);
            $tabSpellTypes[] = $spelltype;
        }


        /**
         * Default spells
         */
        $spells = [
            ["Ame de Chardros", "Augmente le POU", 2, 50, $tabSpellTypes[4]],
            ["Armure Infernale", "Protection +4", 0, 10, $tabSpellTypes[0]],
            ["Assimiler Forme", "Prendre la forme d'un autre humain ou d'un animal naturel", 3, 20, $tabSpellTypes[1]],
            ["Vue du Démon", "Permet au sorcier de voir des objets particuliers", 1, 30, $tabSpellTypes[1]],
            ["Corne de Hionhurn", "CON +3 par point de magie utilisé", 2, 20, $tabSpellTypes[4]],
        ];

        foreach ($spells as list($a, $b, $c, $d, $e)) {
            $spell = new Spell();
            $spell->setName($a)
                ->setEffect($b)
                ->setReach($c)
                ->setZone($d)
                ->setSpellType($e)
                ->addGame($this->getReference('game1'));
            $manager->persist($spell);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 8;
    }
}
