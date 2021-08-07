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
            ['Carkan le jeune', 'carkan.png', 'Homme', 'droitier', '2m00', '80kg', 'Grand, fin, calme, un peu renfrogné quelques fois',
                '24', 'Paumettes proéminentes; Yeux sombres et creux, Tatouages tribaux', 'Il fut embarqué sur un bâteau le long des côtes des Terres désolées et humides. Il a fuit les meurtriers de sa famille. Quand il sera prêt, il retournera dans sa contrée pour assouvir sa vengeance.',
                true, 'Chaos 0 - Balance 0 - Loi 3', 'Sur un bâteau', 'Terres désolées et humides', '80', 'game1'],
            ['Tabita Of Ness', 'tabita.jpg', 'Femme', 'Gaucher', '', '', '', '22', '', '', true, 'Chaos 0 - Balance 0 - Loi 3', '', '', '570', 'game1'],
            ['Bort Of Pikarayd', 'bort.jpg', 'Homme', 'Gaucher', '', '', '', '21', '', '', true, 'Chaos 3 - Balance 0 - Loi 0', '', '', '220', 'game1'],
            ['Rathek', 'rathek.jpg', 'Homme', 'Droitier', '', '', '', '25', '', '', true, 'Chaos 0 - Balance 3 - Loi 0', '', '', '2100', 'game1'],
            ['Vreen', 'vreen.jpg', 'Femme', 'Droitier', '', '', '', '19', '', '', true, 'Chaos 0 - Balance 3 - Loi 0', '', '', '660', 'game1'],
            ['Kevi', 'kevi.jpg', 'Femme', 'Droitier', '', '', '', '20', '', '', true, 'Chaos 3 - Balance 0 - Loi 0', '', '', '160', 'game1'],
            ['Maryse Boucher', 'maryse.jpg', 'Femme', '', '1m65', '52kg', 'Dans sa combinaison de vol, les cheveux généralement  noués  sous  une  casquette 
            ou  parfois  sous  un  casque,  il  est  facile  de  
            confondre Maryse avec un homme. De près, son joli minois met fin à l’illusion mais son regard déterminé et sa démarche volontaire confirment un caractère impétueux.',
                '27', '', 'Pilote - Issue  d’une  famille  modeste  qui  a  quitté 
            l’Alsace pour rester française, Maryse rêvait d’aviation  et  de  records  en  admirant  les  appareils  militaires  en  vol.  Sans  diplôme  
            et sans argent, elle a financé son brevet de 
            pilote en devenant mécanicienne.', true, '', 'France', 'Alsace', '200', 'game2'],
            ['Lord Duncan Blight', 'duncan.jpg', 'Homme', '', '1m81', '82kg', 'Duncan est un homme de haute stature, à la mise soignée et aux manières distinguées, 
            mais  son  visage  porte  les  stigmates  de  la  guerre.  L’élégance  de  ses  costumes  peine  
            à dissimuler une nature plus brutale et on l’imagine tout autant à son aise en bras de chemise dans une guerre des gangs que dans un salon de thé.',
                '42', '', 'Militaire - Ancien  colonel  de  l’armée  britannique, Duncan est issu d’une riche famille aristo-
            cratique. Grand amateur de rugby et de boxe, malgré des états de services irréprochables, il a quitté l’armée pour acheter une salle de boxe à New-York.', true, '', 'New-York', '', '200', 'game2'],
            ['Francesca Petrini', 'francesca.jpg', 'Femme', '', '1m67', '57kg', 'Francesca  est  une  jeune  femme  élégante  
            mais timide, qui cache son embarras sous un chapeau à large bord. Toutefois, celui qui parvient à croiser son regard en mesure im-médiatement toute l’acuité, c’est alors géné-
            ralement à son tour de baisser les yeux.', '31', '', 'Archéologue - À la mort de son père, cette jeune italienne 
            a pris la décision de terminer l’ouvrage que 
            son paternel avait commencé à écrire sur les rites funéraires des indiens d’Amérique. Dès lors, elle s’est installée à New-York afin de mener ce projet à bien et de profiter de la 
            large communauté italienne qui y réside.', true, '', 'New-York', 'Italie', '200', 'game2'],
            ['John Prentiss', 'john.jpg', 'Homme', '', '1m74', '70kg', 'La  mâchoire  carrée,  le  regard  franc  et  la parole facile, John est un jeune homme athlé-
            tique qui semble partout à son aise. Chemise entrouverte, chapeau de cuir, il soigne son allure de baroudeur et ne se sépare jamais 
            d’un carnet dans lequel il prend note de ses 
            exploits, réels ou imaginaires.', '29', '', 'Aventurier - Fils  d’un  riche  industriel  américain,  John 
            a  été  élevé  par  une  nourrice  noire.  Il  en  a  
            conçu une grande amertume pour les théo-
            ries racistes de sa famille et, très jeune, est parti explorer le monde, relatant ses voyages dans des romans qui connaissent un succès 
            d’estime.', true, '', '', '', '200', 'game2'],
            ['Ilia Droudji', 'ilia.jpg', 'Femme', '', '1m63', '49kg', 'Avec  sa  longue  chevelure  noire,  sa  dé-
            marche souple et son regard d’orientale, Ilia possède un charme explosif. Elle arbore tou-
            tefois des tenues plutôt discrètes, dans des tons de verts et de bruns. Elle possède l’éton-
            nante capacité de savoir à la fois disparaître dans les ombres en un clin d’œil et de briller de mille feux en société.',
                '23', '', 'Journaliste - Née à Constantinople, d’une famille israé-
            lite de l’Empire Ottoman, Ilia et sa famille ont émigré à New-York peu de temps avant 
            la  dissolution  de  l’empire.  Douée  pour  les  langues,  la  jeune  femme  déracinée  y  est  devenue journaliste.', true, '',
                'New-York', 'Constantinople', '200', 'game2'],
            ['Professeur Johan Kerenski', 'kerenski.jpg', 'Homme', '', '1m86', '71kg', 'Grand et maigre, le sourcil broussailleux, le professeur Kerenski semble en permanence absorbé par des détails auxquels lui seul est sensible. Son costume gris, austère et chif-
            fonné, suggère qu’il n’a pas dormi depuis longtemps ou alors tout habillé, tandis que son regard est habité d’une flamme d’une 
            rare intensité.', '47', '', 'Thérapeute - Passionné  de  paranormal  et  de  métaphy-
            sique, le jeune Johan s’est intéressé très tôt aux  théories  modernes  de  psychologie.  Il tente désormais de créer sa propre méthode thérapeutique en travaillant plus particuliè-rement  sur  les  maladies  mentales  dans  les  civilisations préindustrielles.', true, '',
                '', '', '200', 'game2'],
        ];
        $z = 0;
        foreach ($tabCharac as list($a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k, $l, $m, $n, $o, $p)) {
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
                ->setGame($this->getReference($p));
            $manager->persist($character);
            $this->addReference('character' . $z, $character);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
