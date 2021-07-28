<?php
namespace App\DataFixtures;

use App\Entity\Spell;
use App\Entity\SpellType;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class SpellFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        // Type de sort        
        $spelltypes = [
            ["Sorts de combat"],
            ["Sorts d'action"],
            ["Sorts de l'Etre"],
            ["Sorts du Monde Invisible"],
            ["Sorts de caractéristique"],
            ["Sorts des élèments"],
            ["Sorts d'intensification"],
        ];

        $i = 0;
        foreach ($spelltypes as list($a))
        {
            $i++;
            $spelltype = new SpellType();
            $spelltype->setName($a); 
            $tabspelltype[$i] = $spelltype;           
            $manager->persist( $spelltype );
        }
        unset($a, $i); 

        // Sort        
        $spells = [
            ["Ame de Chardros", "Augmente le POU", 2, 50, $tabspelltype[5]],
            ["Armure Infernale", "Protection +4", 0, 10, $tabspelltype[1]],
            ["Assimiler Forme", "Prendre la forme d'un autre humain ou d'un animal naturel", 3, 20, $tabspelltype[2]],
            ["Vue du Démon", "Permet au sorcier de voir des objets particuliers", 1, 30, $tabspelltype[2]],
            ["Corne de Hionhurn", "CON +3 par point de magie utilisé", 2, 20, $tabspelltype[5]],
        ];

        foreach ($spells as list($a, $b, $c, $d, $e))
        {
            $spell = new Spell();
            $spell->setName($a);   
            $spell->setEffect($b);  
            $spell->setReach($c);  
            $spell->setZone($d);    
            $spell->setSpellType($e);   
            $manager->persist( $spell );
        }
        unset($a, $b, $c, $d, $e);


        $manager->flush();
    }

    public function getOrder()
    {
        return 8;
    }
}