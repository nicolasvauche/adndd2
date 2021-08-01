<?php

namespace App\DataFixtures;

use App\Entity\Skill;
use App\Entity\GameSkill;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class SkillFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /**
         * Default skills
         */
            
        $tabSkills = [
            "Esquive",
            "Réparation et bricolage",
            "Déguisement",
            "Perception",
            "Langue maternelle (courant)",
            "Monde naturel",
            "Chevaucher",
            "Aperçu",
            "Négociation",
            "Parler vite",
            "Art oratoire",
            "Recherche",
            "Crochetage",
            "Cacher",
            "Artisanat",
            "Écoute",
            "Navigation",
            "Premiers soins",
            "Naviguer",
            "Écriture",
            "Grimper",
            "Dissimuler objet",
            "Autres langages (Melnibonéan)",
            "Autres langages (courant)",
            "Langue maternelle (Mong)",
            "Pistage",
            "Piégeage",
            "Art (Torture)",
            "Saut",
            "Déplacement discret",
            "Flairer parfum",
            "Nager",
            "Lancer",
            "Art (Courtoisie)",
            "Jeune Royaume",
            "Potions",
            "Art (Conversation)",
        ];

        foreach ($tabSkills as $key => $value)
        {
            $skill = new Skill();
            $skill->setName($value);
            $manager->persist( $skill );

            $gameSkill = new GameSkill();
            $gameSkill->setGame($this->getReference('game1'))
                    ->setSkill($skill)
                    ->setBase('50');
            $manager->persist( $gameSkill );
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 9;
    }
}
