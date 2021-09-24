<?php

namespace App\DataFixtures;

use App\Entity\Character;
use App\Entity\Game;
use App\Entity\Scenario;
use App\Entity\User;
use App\Entity\Tribe;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CharacterFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /**
         * Default character Elric
         */

        $tabCharac = [
            ['Carkan', 'carkan.png', 'Homme', 'Gaucher', '2m15', '90kg', '',
                '24', 'Grand, fin, calme, un peu renfrogné quelques fois ... Paumettes proéminentes; Yeux sombres et creux, Tatouages tribaux', 'Il fut embarqué sur un bâteau le long des côtes des Weeping Waste. Il a fuit les meurtriers de sa famille. Quand il sera prêt, il retournera dans sa contrée pour assouvir sa vengeance.',
                true, '', 'Sur un bâteau', 'Weeping Waste', '80', 'game1', "Le Jeune", '0', '0', '3'],


            ['Tabita Of Ness', 'tabita.jpg', 'Femme', 'Droitier', '1m75', '60kg', '', 
            '22', "Ses ennemis l'appellent « Sourcils » à cause de leur épaisseur et de la façon dont ils essaient de se rencontrer.", "Elle est deuxième derrière le Thane de Ness, un petit propriétaire de Vilmir. Dépassant sa position relativement basse, elle est arrogante, insistante sur les voies de la Loi.",
            true, '', '', '', '570', 'game1','', '0', '0', '3'],

            ['Bort Of Pikarayd', 'bort.jpg', 'Homme', 'Droitier', '2m00', '120kg', '',
                 '21', "Bort est grand, mince, intense, ambitieux et agressif. Il aime les batailles d'esprit ; il voit moins à gagner aux combats physiques, bien qu'il ait beaucoup de courage.", "Comme il se sent très intelligent, Bort est convaincu qu'il peut cueillir les fruits du Chaos sans s'emmêler. Bien que peu en sachent beaucoup sur lui, certains disent que son père était un puissant sorcier qui a abandonné sa famille à Pikarayd sur ordre du Chaos.", 
                true, '', '', '', '220', 'game1','', '3', '0', '0'],

            ['Rathek', 'rathek.jpg', 'Homme', 'Droitier', '1m65', '60kg', '',
                 '25', "C'est un jeune Homme solennel au cœur bienveillant. Son bras gauche est légèrement plus court que son droit, et son corps semble donc penché vers la droite.", "Rathek est le fils aîné des commerçants Shazarian. Il erre quelque temps au travail après avoir fréquenté l'université de Cadsandria, à Argimiliar. Son surnom vient d'un passe-temps alors qu'il était étudiant, d'enquêter sur des tunnels, des grottes et des tumulus près de Cadsandria", 
                true, '', '', '', '2100', 'game1','Le Lapin', '0', '3', '0'],

            ['Vreen', 'vreen.jpg', 'Femme', 'Droitier', '1m70', '60kg', '',
                 '19', '', "Elle est la plus jeune fille d'une vieille et riche famille de l'île des villes pourpres, croyantes bien connues dans l'équilibre, elles sont tolérées, bien que soupçonnées de libre pensée et d'autres crimes tels qu'un régime légal peut dicter. Elle a juré d'éviter de tuer dans la mesure du possible.", 
                 true, '', '', '', '660', 'game1','La Guérisseuse', '0', '3', '0'],

            ['Kevi', 'kevi.jpg', 'Femme', 'Gaucher', '1m90', '75kg', '',
                 '20', 'Trop belle pour ne pas se démarquer, Kevi porte généralement un voile.', "Elle est la fille d'un pirate du continent sud et d'une captive. Kevi erre sur les terres comme son parent pirate, prenant ce qu'elle veut. Lorsqu'elle laisse voir son visage, tous ceux qui la voient sont frappés par sa vitalité et ses manières désinvoltes.", 
                 true, '', '', '', '160', 'game1','La Voleuse', '3', '0', '0'],

// -------------------------------------------------------------------------------------------------------------------------------

            ['Maryse Boucher', 'maryse.jpg', 'Femme', 'Gaucher', '1m65', '52kg', 'Dans sa combinaison de vol, les cheveux généralement  noués  sous  une  casquette 
            ou  parfois  sous  un  casque,  il  est  facile  de  
            confondre Maryse avec un h. De près, son joli minois met fin à l’illusion mais son regard déterminé et sa démarche volontaire confirment un caractère impétueux.',
                '27', '', 'Pilote - Issue  d’une  famille  modeste  qui  a  quitté 
            l’Alsace pour rester française, Maryse rêvait d’aviation  et  de  records  en  admirant  les  appareils  militaires  en  vol.  Sans  diplôme  
            et sans argent, elle a financé son brevet de pilote en devenant mécanicienne.', true, '', 'France', 'Alsace', '200', 'game2', null, null, null, null],


            ['Lord Duncan Blight', 'duncan.jpg', 'Homme', 'Droitier', '1m81', '82kg', 'Duncan est un Homme de haute stature, à la mise soignée et aux manières distinguées, 
            mais  son  visage  porte  les  stigmates  de  la  guerre.  L’élégance  de  ses  costumes  peine  
            à dissimuler une nature plus brutale et on l’imagine tout autant à son aise en bras de chemise dans une guerre des gangs que dans un salon de thé.',
                '42', '', 'Militaire - Ancien  colonel  de  l’armée  britannique, Duncan est issu d’une riche famille aristo-
            cratique. Grand amateur de rugby et de boxe, malgré des états de services irréprochables, il a quitté l’armée pour acheter une salle de boxe à New-York.', true, '', 'New-York', '', '200', 'game2', null, null, null, null],

            ['Francesca Petrini', 'francesca.jpg', 'Femme', 'Droitier', '1m67', '57kg', 'Francesca  est  une  jeune  Femme  élégante  
            mais timide, qui cache son embarras sous un chapeau à large bord. Toutefois, celui qui parvient à croiser son regard en mesure immédiatement toute l’acuité, c’est alors généralement à son tour de baisser les yeux.', '31', '', 'Archéologue - À la mort de son père, cette jeune italienne 
            a pris la décision de terminer l’ouvrage que 
            son paternel avait commencé à écrire sur les rites funéraires des indiens d’Amérique. Dès lors, elle s’est installée à New-York afin de mener ce projet à bien et de profiter de la 
            large communauté italienne qui y réside.', true, '', 'New-York', 'Italie', '200', 'game2', null, null, null, null],

            ['John Prentiss', 'john.jpg', 'Homme', 'Droitier', '1m74', '70kg', 'La  mâchoire  carrée,  le  regard  franc  et  la parole facile, John est un jeune Homme athlétique qui semble partout à son aise. Chemise entrouverte, chapeau de cuir, il soigne son allure de baroudeur et ne se sépare jamais 
            d’un carnet dans lequel il prend note de ses 
            exploits, réels ou imaginaires.', '29', '', 'Aventurier - Fils  d’un  riche  industriel  américain,  John 
            a  été  élevé  par  une  nourrice  noire.  Il  en  a  
            conçu une grande amertume pour les théories racistes de sa famille et, très jeune, est parti explorer le monde, relatant ses voyages dans des romans qui connaissent un succès 
            d’estime.', true, '', '', '', '200', 'game2', null, null, null, null],

            ['Ilia Droudji', 'ilia.jpg', 'Femme', 'Droitier', '1m63', '49kg', 'Avec  sa  longue  chevelure  noire,  sa  démarche souple et son regard d’orientale, Ilia possède un charme explosif. Elle arbore toutefois des tenues plutôt discrètes, dans des tons de verts et de bruns. Elle possède l’étonnante capacité de savoir à la fois disparaître dans les ombres en un clin d’œil et de briller de mille feux en société.',
                '23', '', 'Journaliste - Née à Constantinople, d’une famille israélite de l’Empire Ottoman, Ilia et sa famille ont émigré à New-York peu de temps avant 
            la  dissolution  de  l’empire.  Douée  pour  les  langues,  la  jeune  Femme  déracinée  y  est  devenue journaliste.', true, '',
                'New-York', 'Constantinople', '200', 'game2', null, null, null, null],

            ['Professeur Johan Kerenski', 'kerenski.jpg', 'Homme', 'Gaucher', '1m86', '71kg', 'Grand et maigre, le sourcil broussailleux, le professeur Kerenski semble en permanence absorbé par des détails auxquels lui seul est sensible. Son costume gris, austère et chiffonné, suggère qu’il n’a pas dormi depuis longtemps ou alors tout habillé, tandis que son regard est habité d’une flamme d’une 
            rare intensité.', '47', '', 'Thérapeute - Passionné  de  paranormal  et  de  métaphysique, le jeune Johan s’est intéressé très tôt aux  théories  modernes  de  psychologie.  Il tente désormais de créer sa propre méthode thérapeutique en travaillant plus particulièrement  sur  les  maladies  mentales  dans  les  civilisations préindustrielles.', true, '',
                '', '', '200', 'game2', null, null, null, null],

        ];


        $z = 0;
        foreach ($tabCharac as list($a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k, $l, $m, $n, $o, $p, $q, $r, $s, $t)) {
            $z++;
            $character = new Character();
            $character->setName($a)
                ->setAvatar($b)
                ->setGender($c)
                ->setGuidingHand($d)
                ->setSize($e)
                ->setWeight($f)
                ->setDescription($g)
                ->setAge($h)
                ->setDistinctive($i)
                ->setStory($j)
                ->setIsPremade($k)
                ->setAllegiance($l)
                ->setHomeplace($m)
                ->setBirthplace($n)
                ->setCoinpurse($o)
                ->setGame($this->getReference($p))
                ->setSurname($q)
                ->setChaos($r)
                ->setBalance($s)
                ->setLoi($t);

            $manager->persist($character);
            $this->addReference('character' . $z, $character);
        }

        $zz = 1;
        foreach ($tabCharac as list($a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k, $l, $m, $n, $o, $p, $q, $r, $s, $t)) {
            $z++;
            if ($zz > 4) {
                $zz = 1;
            }
            $playerCharacter = new Character();
            $playerCharacter->setName($a)
                ->setAvatar($b)
                ->setGender($c)
                ->setGuidingHand($d)
                ->setSize($e)
                ->setWeight($f)
                ->setDescription($g)
                ->setAge($h)
                ->setDistinctive($i)
                ->setStory($j)
                ->setIsPremade(false)
                ->setAllegiance($l)
                ->setHomeplace($m)
                ->setBirthplace($n)
                ->setCoinpurse($o)
                ->setGame($this->getReference($p))
                ->setSurname($q)
                ->setChaos($r)
                ->setBalance($s)
                ->setLoi($t)
                ->setUser($this->getReference('user' . $zz));
            $manager->persist($playerCharacter);
            $this->addReference('character' . $z, $playerCharacter);

            $zz++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
