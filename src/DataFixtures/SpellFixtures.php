<?php

namespace App\DataFixtures;

use App\Entity\Spell;
use App\Entity\SpellType;
use App\Entity\Game;
use App\Entity\CharacterSpell;

use App\Repository\GameRepository;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class SpellFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        /**
         * Elric spell types
         */
        $tabSpellTypesElric = [];

        $spelltypesElric = [
            "Sorts de Combat",
            "Sorts d'Action",
            "Sorts de l'Être",
            "Sorts du Monde Invisible",
            "Sorts de Caractéristique",
            "Sorts des Éléments",
            "Sorts d'Intensification",
        ];


        foreach ($spelltypesElric as $key => $value) {
            $spelltype = new SpellType();
            $spelltype->setName($value);
            $manager->persist($spelltype);
            $tabSpellTypesElric[] = $spelltype;
        }

        /**
         * Elric spells
         */

        $spells = [
            ["Armure de l'Enfer", "1-4", 2, 50, $tabSpellTypesElric[0]],
            ["Rempart de l'Enfer", "1-4", 0, 10, $tabSpellTypesElric[0]],
            ["Marteau de l'Enfer", "1-4", 3, 20, $tabSpellTypesElric[0]],
            ["Rasoir de l'Enfer", "1-4", 1, 30, $tabSpellTypesElric[0]],
            ["Flamme vive de l'Enfer", "1-4", 2, 20, $tabSpellTypesElric[0]],
            ["Serres de l'Enfer", "1-4", 2, 20, $tabSpellTypesElric[0]],

            ["Liens incassables", "3", 2, 50, $tabSpellTypesElric[1]],
            ["Souffle de Vie", "1", 0, 10, $tabSpellTypesElric[1]],
            ["Yeux de la Buse", "1", 3, 20, $tabSpellTypesElric[1]],
            ["Oreille du Démon", "1", 1, 30, $tabSpellTypesElric[1]],
            ["Yeux du Démon", "1", 2, 20, $tabSpellTypesElric[1]],
            ["Soigner", "2", 2, 20, $tabSpellTypesElric[1]],
            ["Comparer la forme", "4", 2, 50, $tabSpellTypesElric[1]],
            ["Attacher", "1", 0, 10, $tabSpellTypesElric[1]],
            ["Tout faire", "3", 3, 20, $tabSpellTypesElric[1]],
            ["Minuit", "1", 1, 30, $tabSpellTypesElric[1]],
            ["Lever de Lune", "1", 2, 20, $tabSpellTypesElric[1]],
            ["Vision du Rat", "1", 2, 20, $tabSpellTypesElric[1]],

            ["Fureur", "1", 2, 20, $tabSpellTypesElric[2]],
            ["Confusion", "1", 2, 20, $tabSpellTypesElric[2]], 
            
            ["Brasero de Puissance", "4", 2, 50, $tabSpellTypesElric[3]],
            ["Chaîne d'être", "4", 0, 10, $tabSpellTypesElric[3]],
            ["Chaîne du Chaos", "4", 3, 20, $tabSpellTypesElric[3]],
            ["Malédiction du Chaos", "4", 1, 30, $tabSpellTypesElric[3]],
            ["Domaine du Droit", "4", 2, 20, $tabSpellTypesElric[3]],
            ["Quatre en Un", "2-8", 2, 20, $tabSpellTypesElric[3]],
            ["Membrane de Loi", "3", 2, 50, $tabSpellTypesElric[3]],
            ["Variole", "1", 0, 10, $tabSpellTypesElric[3]],
            ["Réfutation", "1-4", 3, 20, $tabSpellTypesElric[3]],
            ["Invoquer BL/PL", "5", 1, 30, $tabSpellTypesElric[3]],
            ["Invoquer un Démon", "1", 2, 20, $tabSpellTypesElric[3]],
            ["Invoquer l'Élémentaire", "1", 2, 20, $tabSpellTypesElric[3]],            
            ["Annuler la Magie", "1-4", 3, 20, $tabSpellTypesElric[3]],
            ["Ward", "3", 1, 30, $tabSpellTypesElric[3]],
            ["Vue de la Sorcière", "3", 2, 20, $tabSpellTypesElric[3]],     
            
            ["Maison de Hionhurn", "1-3", 3, 20, $tabSpellTypesElric[4]],
            ["Plasticité de Balo", "1-3", 1, 30, $tabSpellTypesElric[4]],
            ["Tendon de Mabelode", "1-3", 2, 20, $tabSpellTypesElric[4]],
            ["Âme de Chardros", "1-3", 2, 20, $tabSpellTypesElric[4]],            
            ["Vitesse de Vezhan", "1-3", 3, 20, $tabSpellTypesElric[4]],
            ["Souplesse de Xiombarg", "1-3", 1, 30, $tabSpellTypesElric[4]],
            ["Visage d'Arioch", "1-3", 2, 20, $tabSpellTypesElric[4]],
            ["Sagesse de Slortar", "1-3", 2, 20, $tabSpellTypesElric[4]],     
            
            ["Prime de Straasha", "4", 3, 20, $tabSpellTypesElric[5]],
            ["Flammes de Kakatal", "4", 1, 30, $tabSpellTypesElric[5]],
            ["Cadeau de Grome", "4", 2, 20, $tabSpellTypesElric[5]],
            ["Ailes de Lassa", "4", 2, 20, $tabSpellTypesElric[5]],     
            
            ["Manteau de Cran Liret", "1-4", 3, 20, $tabSpellTypesElric[6]],
            ["Gamme de Cran Liret", "1-4", 1, 30, $tabSpellTypesElric[6]],
            ["Certitude de Cran Liret", "1-4", 2, 20, $tabSpellTypesElric[6]],
            ["Semelle de Cran Liret", "1-4", 2, 20, $tabSpellTypesElric[6]],                 
        ]; 

        foreach ($spells as list($a, $b, $c, $d, $e)) {
            $spell = new Spell();
            $spell->setName($a)
                ->setEffect($b)
                ->setReach($c)
                ->setZone($d)
                ->setSpellType($e)
                ->addGame($this->getReference('game1'));
            $tabSpells [] = $spell;
            $manager->persist($spell);
        }


// Ajout de sorts aux personnages -----------------------------------------------------------------------------------------
// Personnage Bort
        $SpellBort = [];
        $SpellBort = [$tabSpells[14], $tabSpells[40], $tabSpells[42]];

        foreach ($SpellBort as &$value) {
            $characterspell = new CharacterSpell();
            $characterspell->setCharacter($this->getReference('character3'))
                    ->setSpell($value);
            $manager->persist($characterspell);
        }

// Personnage Kevi
        $SpellKevi = [];
        $SpellKevi = [$tabSpells[17], $tabSpells[50], $tabSpells[33]];

        foreach ($SpellKevi as &$value) {
            $characterspell = new CharacterSpell();
            $characterspell->setCharacter($this->getReference('character6'))
                    ->setSpell($value);
            $manager->persist($characterspell);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 8;
    }
}
