<?php

namespace App\DataFixtures;

use App\Entity\Dice;
use App\Entity\Diceset;
use App\Entity\Game;
use App\Entity\GameCategory;
use App\Entity\GameRules;
use App\Entity\GameSystem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class GameFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /**
         * Default games
         */
        $game1 = new Game();
        $game1->setName('Elric')
            ->setShortDescription("Elric! est un jeu de rôle médiéval fantastique se déroulant dans l'univers des Jeunes Royaumes (imaginé par Michael Moorcock dans sa saga éponyme), paru en 1993. Il est le successeur du jeu Stormbringer.")
            ->setDescription(
                <<<EOF
<p>
Elric! est un jeu de rôle médiéval fantastique se déroulant dans l'univers des Jeunes Royaumes (imaginé par Michael Moorcock dans sa saga éponyme), paru en 1993. Il est le successeur du jeu Stormbringer. Publié chez Chaosium, dont il utilise le célèbre système "Basic RolePlaying" (à l'instar de L'Appel de Cthulhu, Hawkmoon (lui-même basé sur une saga de Moorcock), etc.), il permet aux joueurs d'incarner majoritairement des humains évoluant dans un monde de magie impie, de créatures élémentaires, et de divinités démoniaques. Son système de jeu simple, efficace et réaliste séduira les débutants tandis que son univers riche et complexe ravira les vétérans. Même s'il ne touche pas un public aussi large que Donjons et Dragons, Elric! reste tout de même un jeu majeur dans l'univers du rôlisme.
</p>
<p>
Le système d'Elric!, bien que fondé sur des principes similaires à ceux de StormBringer, se caractérise par un système de magie radicalement différent, et une création de personnage globalement plus équilibrée. Là où StormBringer ne proposait que des invocations de démons et créatures élémentaires aux personnages, Elric! propose en sus un système de "sorts mineurs", permettant tout un panel d'effets allant du bonus à une compétence au projectile enflammé destiné à blesser un ennemi. La création de personnage proscrit par défaut les Melnibonéens et Pan-Tangiens qui avaient fait les beaux jours des éditions 1 à 4 de StormBringer pour se concentrer sur les humains. Elle produit aussi des personnages globalement beaucoup plus compétents, en n'imposant aucune limite sur les compétences.
</p>
<p>
Chaosium rééditera Elric! en 2001 sous le nom StormBringer 5th Edition.
</p>
<p>
Mongoose Publishing, un éditeur britannique qui avait racheté la licence de Hawkmoon, a publié en 2007 le jeu Elric of Melniboné, avec un système de jeu tiré de la quatrième édition de RuneQuest. Cette nouvelle édition a été traduite en français (ISBN 978-1-906508-76-0) | MGP8163). Une seconde version d' Elric of Melniboné paraitra en 2010 sous la forme d'un supplément pour le jeu RuneQuest II de Mongoose.
</p>
<p>
Le Département des Sombres Projets a acquis les droits d'exploitation en France de Mongoose Publishing en 2011 et a publié Mournblade en décembre 2012.
</p>
EOF
            )
            ->setMedia('cover_elric.jpg')
            ->setIsActive(true);
        $manager->persist($game1);
        $this->addReference('game1', $game1);

        $game2 = new Game();
        $game2->setName("Chroniques Oubliées Cthulhu")
            ->setShortDescription("Chroniques Oubliées peut être considéré comme un jeu de rôle d'initiation. D'heroic fantasy pour ses premières versions, il a été édité en premier lieu en 2009 par Black Book sous forme de boîte.")
            ->setDescription(
                <<<EOF
<p>
Chroniques Oubliées peut être considéré comme un jeu de rôle d'initiation. D'heroic fantasy pour ses premières versions, il a été édité en premier lieu en 2009 par Black Book sous forme de boîte.
</p>
EOF
            )
            ->setMedia('cover_chroniquesoubliees.jpg')
            ->setIsActive(true);
        $manager->persist($game2);
        $this->addReference('game2', $game2);

        /**
         * Default game categories
         */
        $gameCategory1 = new GameCategory();
        $gameCategory1->setName('Heroïc Fantasy')
            ->addGame($game1);
        $manager->persist($gameCategory1);

        $gameCategory2 = new GameCategory();
        $gameCategory2->setName('Contemporain')
            ->addGame($game2);
        $manager->persist($gameCategory2);

        /**
         * Default game rules
         */
        $gameRules1 = new GameRules();
        $gameRules1->setName('Le Livre des Règles')
            ->setFilename('regles_elric_fr.pdf')
            ->setGame($game1);
        $manager->persist($gameRules1);

        $gameRules2 = new GameRules();
        $gameRules2->setName('The Core Book')
            ->setFilename('rules_elric_en.pdf')
            ->setGame($game1);
        $manager->persist($gameRules2);

        $gameRules3 = new GameRules();
        $gameRules3->setName('Feuille de Personnage')
            ->setFilename('personnage_chroniquesoubliees_fr.pdf')
            ->setGame($game2);
        $manager->persist($gameRules3);

        $gameRules4 = new GameRules();
        $gameRules4->setName('Personnages prétirés')
            ->setFilename('personnages_pretires_chroniquesoubliees_fr.pdf')
            ->setGame($game2);
        $manager->persist($gameRules4);

        /**
         * Default game systems
         */
        $gameSystem1 = new GameSystem();
        $gameSystem1->setName('Chaosium')
            ->addGame($game1);
        $manager->persist($gameSystem1);

        $gameSystem2 = new GameSystem();
        $gameSystem2->setName('Chroniques Oubliées')
            ->addGame($game2);
        $manager->persist($gameSystem2);

        /**
         * Default diceset
         */
        $diceset1 = new Diceset();
        $diceset1->setName($gameSystem1->getName())
            ->addGameSystem($gameSystem1);
        $manager->persist($diceset1);

        $diceset2 = new Diceset();
        $diceset2->setName($gameSystem2->getName())
            ->addGameSystem($gameSystem2);
        $manager->persist($diceset2);

        /**
         * Default Dices
         */
        $dice1 = new Dice();
        $dice1->setName('D4')
            ->setFaces(4)
            ->addDiceset($diceset1);
        $manager->persist($dice1);

        $dice2 = new Dice();
        $dice2->setName('D6')
            ->setFaces(6)
            ->addDiceset($diceset1)
            ->addDiceset($diceset2);
        $manager->persist($dice2);

        $dice3 = new Dice();
        $dice3->setName('D8')
            ->setFaces(8)
            ->addDiceset($diceset1);
        $manager->persist($dice3);

        $dice4 = new Dice();
        $dice4->setName('D10')
            ->setFaces(10)
            ->addDiceset($diceset1)
            ->addDiceset($diceset2);
        $manager->persist($dice4);

        $dice5 = new Dice();
        $dice5->setName('D12')
            ->setFaces(12)
            ->addDiceset($diceset1)
            ->addDiceset($diceset2);
        $manager->persist($dice5);

        $dice6 = new Dice();
        $dice6->setName('D20')
            ->setFaces(20)
            ->addDiceset($diceset1);
        $manager->persist($dice6);

        $dice7 = new Dice();
        $dice7->setName('D100')
            ->setFaces(100)
            ->addDiceset($diceset1);
        $manager->persist($dice7);

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
