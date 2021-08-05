<?php

namespace App\DataFixtures;

use App\Entity\Campaign;
use App\Entity\Scenario;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class ScenarioFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /**
         * Default campaigns
         */
        $campaign1 = new Campaign();
        $campaign1->setName("Les navigateurs oubliés")
            ->setGame($this->getReference('game1'));
        $manager->persist($campaign1);

        $campaign2 = new Campaign();
        $campaign2->setName("Mon voisin Nyarlathotep")
            ->setGame($this->getReference('game2'));
        $manager->persist($campaign2);

        /**
         * Default scenarios
         */
        $scenario1 = new Scenario();
        $scenario1->setName("L'île de l'oubli")
            ->setCampaign($campaign1)
            ->setShortDescription("L'aventure débute simplement, un ami des personnages les contacte. L'un de ses proches, un riche marchand, a eu ses deux fils capturés par les pirates de Dhoz-Kam…")
            ->setDescription(
                <<<EOF
<p>
L’aventure débute simplement, un ami des personnages les contacte. L’un de ses proches, un
riche marchand, a eu ses deux fils capturés par les pirates de Dhoz-Kam. Sommé d’apporter
une rançon en échange de leur vie, leur père a déjà rassemblé l’argent. Mais il est âgé et son
état de santé lui interdit d’entreprendre le voyage vers la cité des pirates. Aussi a-t-il demandé
à son ami de lui présenter des personnes de confiance aptes à mener une telle mission. La
tâche n’est pas aisée, convoyer cent mille bronzes à Dhoz-Kam où nulle loi ne règne
représente bien des périls. Les frais du voyage sont couverts par la marchand. Un navire
marchand de Tarkesh, la Baleine, attend leur venue pour appareiller vers la cité des pirates. Si
la beauté du voyage ne suffit pas aux aventuriers, dix mille bronzes attendront chacun au
retour. Les cent mille bronzes leur sont remis en diamants et rubis. A vous de choisir le
contact parmi les relations des personnages. Quant au vieux marchand, faites-en un habitant
du pays où résident vos joueurs.
</p>
EOF
            )
            ->setGame($this->getReference('game1'))
            ->setUser($this->getReference('user1'))
            ->setIsPrivate(false)
            ->setStatus('waiting')
            ->setStartAt(new \DateTime('2021-11-27 20:00:00'));
        $manager->persist($scenario1);

        $scenario2 = new Scenario();
        $scenario2->setName("Un nouveau foyer")
            ->setCampaign($campaign2)
            ->setShortDescription("Vous venez d'emménager dans votre nouvelle maison. Dans le quartier, plutôt calme, seule la maison à côté de la vôtre est habitée. En apparence toutefois : vous n'avez pas encore croisé ses occupants…")
            ->setDescription(
                <<<EOF
<p>
Vous venez d'emménager dans votre nouvelle maison. Tout est bien, une belle maison avec juste ce qu'il faut de pièces, pas trop grandes non plus. Dans le quartier, plutôt calme, seule la maison à côté de la vôtre est habitée. En apparence toutefois : vous n'avez pas encore croisé ses occupants.
</p>
EOF
            )
            ->setGame($this->getReference('game2'))
            ->setUser($this->getReference('user1'))
            ->setIsPrivate(false)
            ->setStatus('waiting')
            ->setStartAt(new \DateTime('2021-12-24 23:59:00'));
        $manager->persist($scenario2);

        $manager->flush();
    }

    public function getOrder()
    {
        return 7;
    }
}
