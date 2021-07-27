<?php

namespace App\DataFixtures;

use App\Entity\Faq;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class FaqFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $i = 0;

        $questions = [
            "1. Puis-je jouer gratuitement ?",
            "2. Si je suis adhérent, puis-je ajouter un jeu sur le site ?",
            "3. Je n'ai pas de caméra, est-ce que je peux quand même participer ?",
            "4. Je n'ai pas encore 18 ans, est-ce que je peux vous rejoindre ?",
            "5. J'ai constaté une erreur sur le site, comment vous la communiquer ?",
            "6. J'ai perdu mon mot de passe !! Aidez-moi",
            "7. J'aimerai beaucoup vous rendre visite, comment faire ?",
            "8. Je souhaite me désabonner, puis-je le faire depuis le site ?",
        ];

        $answers = [
            "Oui, vous pouvez contacter l'administrateur pour qu'il vous crée un compte temporaire vous permettant de participer à une partie de jeu de rôles sur le site ! À la suite de cet essai, vous pourrez décider de rejoindre l'association (moyennant une cotisation annuelle) et débloquer un accès permanent aux parties avec les membres.",
            "Oui, en proposant votre jeu à l'administrateur, celui-ci pourra, ou non, décider d'ajouter votre jeu à la liste des jeux du site.",
            "Bien sûr, dans ce cas, c'est votre avatar de personnage qui s'affichera à la place",
            "Oui, cependant il se peut que certains jeux ne vous soient pas accessibles, c'est le Maître de jeu qui en décidera.",
            "Pour cela, utilisez le formulaire de la page Contact en précisant au mieux où vous l'avez repérée et sa nature.",
            "Ne vous inquiétez pas, vous pouvez tout simplement faire une récupération de mot de passe depuis le menu de connexion et un nouveau mot de passe vous sera envoyé sur votre adresse email.",
            "Cliquez sur le lien 'Nous contacter' dans le pied de page de n'importe quelle page du site, vous trouverez notre adresse, nos horaires, ainsi qu'un plan indiquant nos locaux.",
            "Oui, l'administrateur du site et président de l'association sera alors informé de votre demande et vous recevrez rapidement une confirmation de sa part que votre abonnement a bien été résilié.",
        ];

        foreach ($questions as $question) {
            $faq = new Faq();
            $faq->setQuestion($question)
                ->setAnswer($answers[$i])
                ->setPosition($i + 1);

            $manager->persist($faq);
            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}
