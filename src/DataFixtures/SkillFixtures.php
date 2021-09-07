<?php

namespace App\DataFixtures;

use App\Entity\Skill;
use App\Entity\SkillType;
use App\Entity\GameSkill;
use App\Entity\CharacterSkill;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class SkillFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        /**
         * Chroniques oubliées skill types
         */
        $tabSkillTypes = [];

        $skilltypes = [
            "Voie du danger",
            "Voie de la mécanique",
            "Voie du pilotage",
            "Voie des armes à feu",
            "Voie des corporations (militaire)",
            "Voie du corps à corps",
            "Voie de l’investigation",
            "Voie de l’archéologie",
            "Voie des voyages",
            "Voie des arts",
            "Voie des exploits physiques",
            "Voie de la survie",
            "Voie du discours",
            "Voie de la furtivité",
            "Voie des langues",
            "Voie de la médecine",
            "Voie de la psychologie",
            "Voie des sciences",
        ];

        foreach ($skilltypes as $key => $value) {
            $skilltype = new Skilltype();
            $skilltype->setName($value);
            $manager->persist($skilltype);
            $tabSkillTypes[] = $skilltype;
        }

        /**
         * Elric skill types
         */

        $tabSkillTypesElric = [];
        $skillTypesElric = [
            "Agilité",
            "Communication",
            "Connaissance",
            "Manipulation",
            "Perception",
        ];

        foreach ($skillTypesElric as $key => $value) {
            $skilltype = new Skilltype();
            $skilltype->setName($value);
            $manager->persist($skilltype);
            $tabSkillTypesElric[] = $skilltype;
        }

        /**
         * Elric game skills
         */
            
        $tabSkills = [
            ["Esquive", "DEX X 2%", $tabSkillTypesElric[0]],
            ["Réparation et bricolage", "DEX X 4%", $tabSkillTypesElric[3]],
            ["Déguisement", "15", $tabSkillTypesElric[1]],
            ["Evaluer", "15", $tabSkillTypesElric[2]],
            ["Langue maternelle (courant)", "INT X 5%", $tabSkillTypesElric[1]],
            ["Monde naturel", "25", $tabSkillTypesElric[2]],
            ["Chevaucher", "35", $tabSkillTypesElric[3]],
            ["Aperçu", "15", $tabSkillTypesElric[2]],
            ["Négociation", "15", $tabSkillTypesElric[1]],
            ["Parler vite", "15", $tabSkillTypesElric[1]],
            ["Art oratoire", "5", $tabSkillTypesElric[1]],
            ["Recherche", "20", $tabSkillTypesElric[4]],
            ["Crochetage", "5", $tabSkillTypesElric[3]],
            ["Cacher (se)", "20", $tabSkillTypesElric[3]],
            ["Artisanat", "5", $tabSkillTypesElric[3]],
            ["Écoute", "25", $tabSkillTypesElric[4]],
            ["Navigation", "10", $tabSkillTypesElric[2]],
            ["Premiers soins", "00", $tabSkillTypesElric[0]],
            ["Naviguer", "10", $tabSkillTypesElric[3]],
            ["Écriture", "00", $tabSkillTypesElric[3]],
            ["Grimper", "40", $tabSkillTypesElric[0]],
            ["Dissimuler objet", "25", $tabSkillTypesElric[3]],
            ["Autre langage (Melnibonéan)", "00", $tabSkillTypesElric[1]],
            ["Autre langage (courant)", "00", $tabSkillTypesElric[1]],
            ["Langue maternelle (Mong)", "INT X 5%", $tabSkillTypesElric[1]],
            ["Pistage", "10", $tabSkillTypesElric[4]],
            ["Piégeage", "5", $tabSkillTypesElric[3]],
            ["Art (Torture)", '5', $tabSkillTypesElric[1]],
            ["Saut", "25", $tabSkillTypesElric[0]],
            ["Déplacement discret", "20", $tabSkillTypesElric[0]],
            ["Flairer parfum", "15", $tabSkillTypesElric[4]],
            ["Nager", "25", $tabSkillTypesElric[0]],
            ["Lancer", "25", $tabSkillTypesElric[0]],
            ["Art (Courtoisie)", '5', $tabSkillTypesElric[1]],
            ["Jeune Royaume", "15% / 00 there", $tabSkillTypesElric[2]],
            ["Potions", "00", $tabSkillTypesElric[2]],
            ["Art (Conversation)", '5', $tabSkillTypesElric[1]],
        ];

        $tabSkillsElric = [];
        
        foreach ($tabSkills as list($name, $base, $skilltp))
        {
            $skill = new Skill();
            $skill->setName($name)
                ->setSkillType($skilltp);
            $tabSkillsElric[] = $skill;
            $manager->persist( $skill );

            $gameSkill = new GameSkill();
            $gameSkill->setGame($this->getReference('game1'))
                    ->setSkill($skill)
                    ->setBase($base);
            $manager->persist( $gameSkill );
        }

        /**
         * Elric game skills exists
         */

        $tabSkillsElricEx = [
            ['Art', '5', $tabSkillTypesElric[1]],
            ['Bagarre', '50', $tabSkillTypesElric[0]],
            ['La sphère du million', '00', $tabSkillTypesElric[2]],
            ['Physique', '30', $tabSkillTypesElric[3]],
            ['Royaumes Inconnus', '00 / 15% there', $tabSkillTypesElric[2]],
            ['Lutter', '25', $tabSkillTypesElric[0]],
        ];

        foreach ($tabSkillsElricEx as list($name, $base, $skilltp))
        {
            $skill = new Skill();
            $skill->setName($name)
                ->setSkillType($skilltp);
            $manager->persist( $skill );

            $gameSkill = new GameSkill();
            $gameSkill->setGame($this->getReference('game1'))
                    ->setSkill($skill)
                    ->setBase($base);
            $manager->persist( $gameSkill );
        }


        /**
         * Elric character skills
         */
        $tabgamers = array('character1', 'character2', 'character3', 'character4', 'character5', 'character6');
        $tabcarkan = array("24", "48", "35", "35", "0", "45", "75", "0", "0", "0", "0", "0", "15", "0", "45", "50", "30", "50", "35", "20", "0", "0", "0", "10", "85", "74", "25", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0");
        $tabtabita = array("86", "72", "0", "0", "75", "0", "101", "55", "0", "0", "0", "0", "0", "0", "0", "45", "30", "0", "35", "0", "60", "0", "0", "0", "0", "0", "0", "35", "45", "50", "35", "45", "45", "0", "0", "0", "0");
        $tabbort = array("56", "52", "95", "35", "90", "45", "0", "35", "65", "95", "35", "40", "25", "40", "75", "0", "0", "0", "0", "0", "0", "75", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0");
        $tabrathek = array("30", "60", "35", "95", "90", "85", "55", "0", "95", "35", "25", "40", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "20", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "25", "25", "0", "0");
        $tabvreen = array("30", "60", "35", "35", "75", "45", "0", "95", "14", "65", "25", "40", "25", "40", "0", "0", "0", "101", "0", "20", "0", "45", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "69", "0");
        $tabkevi = array("30", "60", "95", "35", "85", "0", "55", "35", "35", "35", "25", "101", "0", "60", "0", "0", "0", "0", "0", "0", "89", "0", "20", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "25");
        
        $i = 0;
        foreach ($tabgamers as $key)
        {            
            $j = 0;
            foreach ($tabSkillsElric as $value)
            {
                
                $characterskill = new CharacterSkill();
                $characterskill->setCharacter($this->getReference($key));
                $characterskill->setSkill($value);
                $ok =  0;
        
                switch ($i) {
                    case 0:
                        if( $tabcarkan[$j] != '0'){
                            $characterskill->setBase($tabcarkan[$j]); 
                            $ok = 1;
                        }
                        break;
                    case 1:
                        if( $tabtabita[$j] != '0'){
                            $characterskill->setBase($tabtabita[$j]); 
                            $ok = 1;
                        }
                        break;
                    case 2:
                        if( $tabbort[$j] != '0'){
                            $characterskill->setBase($tabbort[$j]); 
                            $ok = 1;
                        }                
                        break;
                    case 3:
                        if( $tabrathek[$j] != '0'){
                            $characterskill->setBase($tabrathek[$j]); 
                            $ok = 1;
                        }     
                        break;
                    case 4:
                        if( $tabvreen[$j] != '0'){
                            $characterskill->setBase($tabvreen[$j]); 
                            $ok = 1;
                        }    
                        break;
                    case 5:
                        if( $tabkevi[$j] != '0'){
                            $characterskill->setBase($tabkevi[$j]); 
                            $ok = 1;
                        } 
                        break;
                }            
            
                $j++;    
                if( $ok == 1){
                    $manager->persist( $characterskill );
                }
            }
            $i++;
        
        }        
         
        /**
         * Chroniques Oubliées skills
         */
   
        $tabSkillsCO = [
            ['Même pas peur', '+1 par rang aux tests de Carac. si danger mortel et tests de choc.', $tabSkillTypes[0]],
            ['Acrobate', '+5 aux tests de DEX pour grimper, sauter., etc. DM des chutes - rang.', $tabSkillTypes[0]],
            ['Ignorer la douleur', '1 fois / combat, ignore les DM d’une att. PV perdus fin du combat.', $tabSkillTypes[0]],
            ['Seul contre tous', '+2 en attaque et en DEF si plusieurs adversaires l’attaquent.', $tabSkillTypes[0]],
            ['Au pied du mur', 'ignore blessure grave en att et FOR. A 0 PV, action avant KO.', $tabSkillTypes[0]],            
            ['Mécano', '+2 / rang aux tests pour réparer ou comprendre des mécanismes.', $tabSkillTypes[1]],
            ['Systèmes modernes', '+2 / rang électricité, radios, etc.', $tabSkillTypes[1]],
            ['Dégoter du matos', '+5 pour trouver du matériel. 1 fois / aventure matériel lourd.', $tabSkillTypes[1]],
            ['Système D', '1 fois/ aventure, réparer sans rien. Pas de malus d’outillage et temps /2.', $tabSkillTypes[1]],
            ['Customisation', '1 fois / jour, en 1d6 x 10 minutes, bonus +2 sur 1 objet (1 semaine).', $tabSkillTypes[1]], 
            ['Pilote émérite', '+2 / rang aux tests de pilotage (DEX) et Init. avec un avion.', $tabSkillTypes[2]],
            ['Manœuvre d’évitement', '+5 pour éviter accidents.  +2 DEF véhicule et passagers.', $tabSkillTypes[2]],
            ['Polyvalent', 'maîtrise un 2e type de véhicule, un 3e au rang 5.', $tabSkillTypes[2]],
            ['En un seul morceau', '1/2 DM de crash et de sortie de route. Chances réduites de véhicule HS.', $tabSkillTypes[2]],
            ['As des as', '2d20 tests au volant d’un véhicule. Valeur de DEX de +2.', $tabSkillTypes[2]],
            ['Ajuster', '+2 en attaque avec les armes à feu jusqu’à la portée de base de l’arme.', $tabSkillTypes[3]],
            ['Joli coup !', 'pas de malus si cible à couvert ou engagée au corps à corps.', $tabSkillTypes[3]],
            ['Tir de précision', 'si Tir visé avec une arme à feu à deux mains, dés de DM x 2.', $tabSkillTypes[3]],
            ['Tir rapide (L)', '2 attaques avec arme à feu, d15 au lieu du d20 pour la seconde.', $tabSkillTypes[3]],
            ['Tireur d’élite', 'd15 en attaque à distance, +2d6 aux DM.', $tabSkillTypes[3]],          
            ['Corporatisme', '+5 à tous les tests de connaissances et +1 / rang tests de CHA (armée).', $tabSkillTypes[4]],
            ['Appel à un ami', '1 / jour, info, aide, etc. Test de CHA 10 à 20 (décision du MJ).', $tabSkillTypes[4]],
            ['50/50', 'coût et temps pour matériel /2, obtenir matériel rare ou illégal.', $tabSkillTypes[4]],
            ['Joker', '1 / aventure, intervention inattendue. Inventer une histoire.', $tabSkillTypes[4]],
            ['Mandarin', '+2 valeur de CHA et d’INT.Voie du corps à corps.', $tabSkillTypes[4]], 
            ['Arts martiaux', 'DM mains nues d4. Rang 3 : d6, rang 5 : d8. +1 / rang DEF vs att et esquive.', $tabSkillTypes[5]],
            ['Arme de prédilection', '+1 en att. Mod. de DEX possible en attaque.', $tabSkillTypes[5]],
            ['Enchaînement', 'au contact, après adversaire vaincu, att gratuite sur un autre.', $tabSkillTypes[5]],
            ['Double attaque (L)', 'deux attaques au contact, d15 au lieu du d20 pour la seconde.', $tabSkillTypes[5]],
            ['Maître d’arme', 'd15 en attaque au contact, +2d6 aux DM.', $tabSkillTypes[5]],
            ['Esprit d’analyse', '+1 / rang aux tests de recherche d’indices.', $tabSkillTypes[6]],
            ['Expertise', '+5 tests Archéologies. Rang 4 : seconde spécialité.', $tabSkillTypes[6]],
            ['Recherche rapide', 'temps de recherche d’indices /2.', $tabSkillTypes[6]],
            ['Mémoire eidétique', 'mémoire infaillible et +5 aux tests de culture générale.', $tabSkillTypes[6]],
            ['Flair infaillible', '2d20 recherche d’indices. Le MJ doit signaler si "Quelque chose cloche".', $tabSkillTypes[6]],
            ['Formation d’historien', '+1 / rang aux tests d’histoire. +5 si amérindiens.', $tabSkillTypes[7]],
            ['Langues anciennes', 'connaît une langue morte / rang. +5 pour les autres.', $tabSkillTypes[7]],
            ['Spéléologue', '+5 pour se faufiler et malus/2 dans le noir et espace exigu.', $tabSkillTypes[7]],
            ['Vigilance', '+5 pour détecter un piège et résister aux effets. DM / 2.', $tabSkillTypes[7]],
            ['Savoirs interdits', '+5 tests contre peur, pouvoirs, perte de PC cause créatures. +2 DEF.', $tabSkillTypes[7]],  
            ['Débrouillardise', '+1 / rang négocier, hébergement. +5 coutumes locales.', $tabSkillTypes[8]],
            ['Par monts et par vaux', 'pas de fatigue. +5 conduite ou à dos d’animal.', $tabSkillTypes[8]],
            ['Sens du danger', '+5 pour ne pas être surpris. Sentir le danger : PER 15.', $tabSkillTypes[8]],
            ['Résistance', '+5 vs maladies, poisons, malus et DM /2. Mange et dort /2.', $tabSkillTypes[8]],
            ['Adaptation héroïque', '+2 valeur de PER et de CON.', $tabSkillTypes[8]],
            ['Formation artistique', '+1 / rang connaissance de l’art. +5 en littérature.', $tabSkillTypes[9]],
            ['Inspiration', 'Relancer un dé (sauf test d’att) 1/ jour par rang.', $tabSkillTypes[9]],
            ['Imprévisible', '+Mod. de CHA en Init et inspiration sur tests d’att et DM.', $tabSkillTypes[9]],
            ['Riche', '10 000 $ / an pendant 10 ans. rang 5 : 20 000 $ par an.', $tabSkillTypes[9]],
            ['Célèbre', '+5 à tous ses tests de CHA. 1 / aventure, l’intervention d’un PNJ puissant.', $tabSkillTypes[9]],
            ['Sportif accompli', '+1 / aux activités sportives (natation, course, lancer, saut, etc.).', $tabSkillTypes[10]],
            ['Spécialité', 'spécialité sportive +5 à tous les tests et bonus selon Carac (voir règles).', $tabSkillTypes[10]],
            ['Se dépasser', 'sacrifier 1 PV, +5 test FOR, DEX ou CON. 1d4 PV, +5 après résultat.', $tabSkillTypes[10]],
            ['Le geste parfait', '1 / jour, 20 naturel FOR, DEX ou CON. 1 / jour att contact ou distance.', $tabSkillTypes[10]],
            ['Entraînement de haut niveau', '+2 valeur Carac. de rang 2. 2d20 garde le meilleur résultat.', $tabSkillTypes[10]],
            ['Ami de la nature', '+2 / rang survie en milieu naturel. 1 / rang Init en pleine nature.', $tabSkillTypes[11]],
            ['Endurant', '+ 1 période de marche par jour, charge transportée x2.', $tabSkillTypes[11]],
            ['Milieux extrêmes', '+5 tests progression en milieux naturels extrêmes.', $tabSkillTypes[11]],
            ['Guide', '+5 survie pour [3 + Mod. de CHA] alliés. Trouve chemin + court ou + sécurisé.', $tabSkillTypes[11]],
            ['Survivant', '2d20 tests CON. Ignore blessure grave sur test Carac. +Mod de CON tests Choc.', $tabSkillTypes[11]],
            ['Beau parleur', '+1 / rang tests de CHA ou INT pour convaincre, séduire, mentir.', $tabSkillTypes[12]],
            ['Provocation (L)', 'test opp de CHA contre INT, la cible à s’énerve ou attaque à -5.', $tabSkillTypes[12]],
            ['Usurpateur', '+5 imitation, déguisement, s’intégrer à une organisation.', $tabSkillTypes[12]],
            ['Manipulateur (L)', '1d6 min, test opp CHA modifie l’état émotionnel de la cible.', $tabSkillTypes[12]],
            ['Charisme héroïque', '+2 valeur de CHA. 2d20 aux tests de CHA.', $tabSkillTypes[12]],
            ['Discrétion', '+2 / rang test de DEX pour passer inaperçu.', $tabSkillTypes[13]],
            ['Sens affûtés', '+1 / rang tests de PER destinés à simuler les sens.', $tabSkillTypes[13]],
            ['Attaque déloyale', '+1d6 DM att de dos ou par surprise. +2d6 au rang 5.', $tabSkillTypes[13]],
            ['Embuscade', 'cacher tous ses compagnons. Adversaires surpris au 1er tour du combat.', $tabSkillTypes[13]],
            ['Perception héroïque', '+2 valeur de PER. 2d20 aux tests de PER.', $tabSkillTypes[13]],
            ['Langues étrangère', 'maîtriser une langue vivante / rang. +5 aux autres.', $tabSkillTypes[14]],
            ['Histoire et culture', '+5 culture générale des pays si langue maîtrisée.', $tabSkillTypes[14]],
            ['Langues mortes', 'maîtrise 1 langue morte  +1/rang suivant. Même bonus culturel.', $tabSkillTypes[14]],
            ['Oreille fantastique', '+5 entendre ou imiter. Empathie test PER opposé CHA cible.', $tabSkillTypes[14]],
            ['Perception supérieure', '+2 valeur de PER. + Mod. de PER en Init. et combat dans le noir.', $tabSkillTypes[14]],
            ['Secouriste', '+1d4 PV à un PJ à 0 PV en 5 mn. +5 tests de CON du patient.', $tabSkillTypes[15]],
            ['Médecin', '+2 / rang médecine, biologie, anatomie. Après repos, Dé de vie du patient x 2.', $tabSkillTypes[15]],
            ['Chirurgien', 'test de DEX 15 (1h), annule effets une seule blessure grave.', $tabSkillTypes[15]],
            ['Frappe chirurgicale', 'critique en att sur 18 à 20 et +1d6 DM des crit.', $tabSkillTypes[15]],
            ['Expert', '+5 précision manuelle.  +2 valeur d’INT. 2d20 tests médecine, chirurgie.', $tabSkillTypes[15]],
            ['À l’écoute', '+2 / rang pour analyser émotions et tests CHA pour obtenir un aveu.', $tabSkillTypes[16]],
            ['Analyse personnelle', '+5 résister aux crises de folie. - 1 point de folie. -1 au rang 4.', $tabSkillTypes[16]],
            ['Aide psychologique', 'soigner folie passagère, CHA (10+PF). Aider un allié.', $tabSkillTypes[16]],
            ['Examen psychologique', 'eviner les émotions (1d6 mn), test opp de PER contre CHA.', $tabSkillTypes[16]],
            ['Intuition héroïque', '+2 valeur de CHA. 2d20 test de PER.', $tabSkillTypes[16]], 
            ['Formation scientifique', '+1 / rang sciences. +2 / rang si paranormal.', $tabSkillTypes[17]],
            ['Grosse tête', 'emplacer test physique par test d’INT.', $tabSkillTypes[17]],
            ['Tacticien', '+ son Mod. d’INT en Init. Relance un dé 1/ jour par rang.', $tabSkillTypes[17]],
            ['Violon d’Ingres', 'choisir 1 capacité de rang 1 à 3 dans une autre voie.', $tabSkillTypes[17]],
            ['Intelligence héroïque', '+2 valeur d’INT. 2d20 aux tests d’INT.', $tabSkillTypes[17]],
        ];

        $i = 1;
        foreach ($tabSkillsCO as list($a, $b, $c))
        {
            $skill = new Skill();
            $skill->setName($a)
                ->setDescription($b)
                ->setSkillType($c);
            $manager->persist( $skill );

            $gameSkill = new GameSkill();
            $gameSkill->setGame($this->getReference('game2'))
                    ->setSkill($skill);
            $manager->persist( $gameSkill );

            $characterskill = new CharacterSkill();
            switch($i){
                case ($i >= 1 && $i <= 15):
                    $characterskill->setCharacter($this->getReference('character7'));
                    break;
                case ($i >= 16 && $i <= 30):
                    $characterskill->setCharacter($this->getReference('character8'));
                    break;
                case ($i >= 31 && $i <= 45):
                    $characterskill->setCharacter($this->getReference('character9'));
                    break;
                case ($i >= 46 && $i <= 60):
                    $characterskill->setCharacter($this->getReference('character10'));
                    break;
                case ($i >= 61 && $i <= 75):
                    $characterskill->setCharacter($this->getReference('character11'));
                    break;
                case ($i >= 76 && $i <= 90):
                    $characterskill->setCharacter($this->getReference('character12'));
                    break;    
                default:
                    break;
            }
            $characterskill->setSkill($skill);
            $manager->persist($characterskill);
            $i++;
        }



        $manager->flush();
    }

    public function getOrder()
    {
        return 9;
    }
}
