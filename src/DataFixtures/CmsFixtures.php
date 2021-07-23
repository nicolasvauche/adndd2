<?php

namespace App\DataFixtures;

use App\Entity\Cms;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class CmsFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $cms1 = new CMS();
        $cms1->setTitle('Mentions légales')
            ->setContent(
                <<<EOF
<p>Merci de lire avec attention les différentes modalités d’utilisation du présent site avant d’y parcourir ses pages . En vous connectant sur ce site, vous acceptez sans réserves les présentes modalités . Aussi, conformément à l’article n°6 de la Loi n°2004 - 575 du 21 Juin 2004 pour la confiance dans l’économie numérique, les responsables du présent site internet < a href = "http://https://www.adndd.fr" > https://www.adndd.fr</a> sont :</p>
<p style="color: #b51a00;">
    <span style="color: rgb(0, 0, 0);"><b> Editeur du Site : </b></span>
</p>
<p> ALIPTIC
    Numéro de SIRET : 790 150 577 00011
    Responsable editorial : N . Vauché
    contact@adndd . fr
    Téléphone :555 - 3623 - 4998 - 0123 - Fax : 444 - 526 - 986
    Email : contact@adndd . fr
    Site Web :
    <a href="http://https://www.adndd.fr"> https://www.adndd.fr</a>
    <br />
</p>
<p style="color: #b51a00;">
    <b>
        <span style="color: rgb(0, 0, 0);"> Hébergement :</span>
    </b>
</p>
<p> Hébergeur : o2switch
    222 Boulevard Gustave Flaubert, 63000 Clermont - Ferrand
    Site Web :
    <a href="http://https://www.o2switch.fr/"> https://www.o2switch.fr/</a>
</p>
<br />
<p style="color: #b51a00;">
    <span style="color: rgb(0, 0, 0);"><b> Développement</b><b> : </b></span>
</p>
<p> Smart Pixels
    Adresse : 50 Boulevard Gambetta, 87000 Limoges
    Site Web :
    <a href="http://www.smartpixels.com"> www . smartpixels . com</a>
</p>
<br />
<p style="color: #b51a00;">
    <span style="color: rgb(0, 0, 0);"><b> Conditions d’utilisation : </b></span>
</p>
<p> Ce site(
    <a href="http://https://www.adndd.fr"> https://www.adndd.fr</a>
    ) est proposé en différents langages web (HTML, HTML5, Javascript, CSS, etc…) pour un meilleur confort d\'utilisation et un graphisme plus agréable, nous vous recommandons de recourir à des navigateurs modernes comme Internet explorer, Safari, Firefox, Google Chrome, etc…
    Les mentions légales ont été générées sur le site < a title = "générateur de mentions légales pour site internet gratuit" href = "http://www.generateur-de-mentions-legales.com" > Générateur de mentions légales </a >, offert par < a title = "imprimerie paris, imprimeur paris" href = "http://welye.com" > Welye</a >.

    <span style="color: #323333;"> ALIPTIC<b> </b></span>
    met en œuvre tous les moyens dont elle dispose, pour assurer une information fiable et une mise à jour fiable de ses sites internet . Toutefois, des erreurs ou omissions peuvent survenir . L\'internaute devra donc s\'assurer de l\'exactitude des informations auprès de , et signaler toutes modifications du site qu\'il jugerait utile. n\'est en aucun cas responsable de l\'utilisation faite de ces informations, et de tout préjudice direct ou indirect pouvant en découler.

    <b>Cookies</b>
    : Le site
    <a href="http://https://www.adndd.fr">https://www.adndd.fr</a>
    peut-être amené à vous demander l’acceptation des cookies pour des besoins de statistiques et d\'affichage. Un cookies est une information déposée sur votre disque dur par le serveur du site que vous visitez. Il contient plusieurs données qui sont stockées sur votre ordinateur dans un simple fichier texte auquel un serveur accède pour lire et enregistrer des informations . Certaines parties de ce site ne peuvent être fonctionnelles sans l’acceptation de cookies.

    <b>Liens hypertextes :</b>
    Les sites internet de peuvent offrir des liens vers d’autres sites internet ou d’autres ressources disponibles sur Internet. ALIPTIC ne dispose d\'aucun moyen pour contrôler les sites en connexion avec ses sites internet. ne répond pas de la disponibilité de tels sites et sources externes, ni ne la garantit. Elle ne peut être tenue pour responsable de tout dommage, de quelque nature que ce soit, résultant du contenu de ces sites ou sources externes, et notamment des informations, produits ou services qu’ils proposent, ou de tout usage qui peut être fait de ces éléments. Les risques liés à cette utilisation incombent pleinement à l\'internaute, qui doit se conformer à leurs conditions d\'utilisation.

    Les utilisateurs, les abonnés et les visiteurs des sites internet de ne peuvent mettre en place un hyperlien en direction de ce site sans l\'autorisation expresse et préalable de ALIPTIC.

    Dans l\'hypothèse où un utilisateur ou visiteur souhaiterait mettre en place un hyperlien en direction d’un des sites internet de ALIPTIC, il lui appartiendra d\'adresser un email accessible sur le site afin de formuler sa demande de mise en place d\'un hyperlien. ALIPTIC se réserve le droit d’accepter ou de refuser un hyperlien sans avoir à en justifier sa décision.
</p>
<br />
<p style="color: #b51a00;">
    <span style="color: rgb(0, 0, 0);"><b>Services fournis : </b></span>
</p>
<p style="color: #323333;">L\'ensemble des activités de la société ainsi que ses informations sont présentés sur notre site
    <a href="http://https://www.adndd.fr">https://www.adndd.fr</a>
    .
</p>
<p style="color: #323333;">ALIPTIC s’efforce de fournir sur le site https://www.adndd.fr des informations aussi précises que possible. les renseignements figurant sur le site
    <a href="http://https://www.adndd.fr">https://www.adndd.fr</a>
    ne sont pas exhaustifs et les photos non contractuelles. Ils sont donnés sous réserve de modifications ayant été apportées depuis leur mise en ligne. Par ailleurs, tous les informations indiquées sur le site https://www.adndd.fr
    <span style="color: #000000;"><b> </b></span>
    sont données à titre indicatif, et sont susceptibles de changer ou d’évoluer sans préavis.
</p>
<br />
<p style="color: #b51a00;">
    <span style="color: rgb(0, 0, 0);"><b>Limitation contractuelles sur les données : </b></span>
</p>
<p>Les informations contenues sur ce site sont aussi précises que possible et le site remis à jour à différentes périodes de l’année, mais peut toutefois contenir des inexactitudes ou des omissions. Si vous constatez une lacune, erreur ou ce qui parait être un dysfonctionnement, merci de bien vouloir le signaler par email, à l’adresse contact@adndd.fr, en décrivant le problème de la manière la plus précise possible (page posant problème, type d’ordinateur et de navigateur utilisé, …).

    Tout contenu téléchargé se fait aux risques et périls de l\'utilisateur et sous sa seule responsabilité. En conséquence, ne saurait être tenu responsable d\'un quelconque dommage subi par l\'ordinateur de l\'utilisateur ou d\'une quelconque perte de données consécutives au téléchargement.
    <span style="color: #323333;">De plus, l’utilisateur du site s’engage à accéder au site en utilisant un matériel récent, ne contenant pas de virus et avec un navigateur de dernière génération mis-à-jour</span>

    Les liens hypertextes mis en place dans le cadre du présent site internet en direction d\autres ressources présentes sur le réseau Internet ne sauraient engager la responsabilité de ALIPTIC.
</p>
<br />
<p style="color: #b51a00;">
    <span style="color: rgb(0, 0, 0);"><b>Propriété intellectuelle :</b></span>
</p>
<p>Tout le contenu du présent sur le site
    <a href="http://https://www.adndd.fr">https://www.adndd.fr</a>
    , incluant, de façon non limitative, les graphismes, images, textes, vidéos, animations, sons, logos, gifs et icônes ainsi que leur mise en forme sont la propriété exclusive de la société à l\'exception des marques, logos ou contenus appartenant à d\'autres sociétés partenaires ou auteurs.

    Toute reproduction, distribution, modification, adaptation, retransmission ou publication, même partielle, de ces différents éléments est strictement interdite sans l\'accord exprès par écrit de ALIPTIC. Cette représentation ou reproduction, par quelque procédé que ce soit, constitue une contrefaçon sanctionnée par les articles L.335-2 et suivants du Code de la propriété intellectuelle. Le non-respect de cette interdiction constitue une contrefaçon pouvant engager la responsabilité civile et pénale du contrefacteur. En outre, les propriétaires des Contenus copiés pourraient intenter une action en justice à votre encontre.
</p>
<br />
<p style="color: #b51a00;">
    <span style="color: rgb(0, 0, 0);"><b>Déclaration à la CNIL : </b></span>
</p>
<p>Conformément à la loi 78-17 du 6 janvier 1978 (modifiée par la loi 2004-801 du 6 août 2004 relative à la protection des personnes physiques à l\'égard des traitements de données à caractère personnel) relative à l\'informatique, aux fichiers et aux libertés, ce site a fait l\'objet d\'une déclaration 1647962 auprès de la Commission nationale de l\'informatique et des libertés (
    <a href="http://www.cnil.fr/">www.cnil.fr</a>
    ).
</p>
<br />
<p style="color: #b51a00;">
    <span style="color: rgb(0, 0, 0);"><b>Litiges : </b></span>
</p>
<p>Les présentes conditions du site
    <a href="http://https://www.adndd.fr">https://www.adndd.fr</a>
    sont régies par les lois françaises et toute contestation ou litiges qui pourraient naître de l\'interprétation ou de l\'exécution de celles-ci seront de la compétence exclusive des tribunaux dont dépend le siège social de la société. La langue de référence, pour le règlement de contentieux éventuels, est le français.
</p>
<br />
<p style="color: #b51a00;">
    <span style="color: rgb(0, 0, 0);"><b>Données personnelles :</b></span>
</p>
<p>De manière générale, vous n’êtes pas tenu de nous communiquer vos données personnelles lorsque vous visitez notre site Internet
    <a href="http://https://www.adndd.fr">https://www.adndd.fr</a>
    .

    Cependant, ce principe comporte certaines exceptions. En effet, pour certains services proposés par notre site, vous pouvez être amenés à nous communiquer certaines données telles que : votre nom, votre fonction, le nom de votre société, votre adresse électronique, et votre numéro de téléphone. Tel est le cas lorsque vous remplissez le formulaire qui vous est proposé en ligne, dans la rubrique « contact ». Dans tous les cas, vous pouvez refuser de fournir vos données personnelles. Dans ce cas, vous ne pourrez pas utiliser les services du site, notamment celui de solliciter des renseignements sur notre société, ou de recevoir les lettres d’information.

    Enfin, nous pouvons collecter de manière automatique certaines informations vous concernant lors d’une simple navigation sur notre site Internet, notamment : des informations concernant l’utilisation de notre site, comme les zones que vous visitez et les services auxquels vous accédez, votre adresse IP, le type de votre navigateur, vos temps d\'accès. De telles informations sont utilisées exclusivement à des fins de statistiques internes, de manière à améliorer la qualité des services qui vous sont proposés. Les bases de données sont protégées par les dispositions de la loi du 1er juillet 1998 transposant la directive 96/9 du 11 mars 1996 relative à la protection juridique des bases de données.
</p>
EOF
            )
            ->setType("legal")
            ->setIsActive(true)
            ->setMedia("cms1.jpg");
        $manager->persist($cms1);

        $cms2 = new CMS();
        $cms2->setTitle("Conditions Générales d'Utilisation")
            ->setContent(
                <<<EOF
<h1>Website Terms and Conditions of Use</h1>

<h2>1. Terms</h2>

<p>By accessing this Website, accessible from https://www.adndd.fr, you are agreeing to be bound by these Website Terms and Conditions of Use and agree that you are responsible for the agreement with any applicable local laws. If you disagree with any of these terms, you are prohibited from accessing this site. The materials contained in this Website are protected by copyright and trade mark law.</p>

<h2>2. Use License</h2>

<p>Permission is granted to temporarily download one copy of the materials on Ah! D &amp; Dédé !\'s Website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:</p>

<ul>
    <li>modify or copy the materials;</li>
    <li>use the materials for any commercial purpose or for any public display;</li>
    <li>attempt to reverse engineer any software contained on Ah! D &amp; Dédé !\'s Website;</li>
    <li>remove any copyright or other proprietary notations from the materials; or</li>
    <li>transferring the materials to another person or "mirror" the materials on any other server.</li>
</ul>

<p>This will let Ah! D &amp; Dédé ! to terminate upon violations of any of these restrictions. Upon termination, your viewing right will also be terminated and you should destroy any downloaded materials in your possession whether it is printed or electronic format.</p>

<h2>3. Disclaimer</h2>

<p>All the materials on Ah! D &amp; Dédé !’s Website are provided "as is". Ah! D &amp; Dédé ! makes no warranties, may it be expressed or implied, therefore negates all other warranties. Furthermore, Ah! D &amp; Dédé ! does not make any representations concerning the accuracy or reliability of the use of the materials on its Website or otherwise relating to such materials or any sites linked to this Website.</p>

<h2>4. Limitations</h2>

<p>Ah! D &amp; Dédé ! or its suppliers will not be hold accountable for any damages that will arise with the use or inability to use the materials on Ah! D &amp; Dédé !’s Website, even if Ah! D &amp; Dédé ! or an authorize representative of this Website has been notified, orally or written, of the possibility of such damage. Some jurisdiction does not allow limitations on implied warranties or limitations of liability for incidental damages, these limitations may not apply to you.</p>

<h2>5. Revisions and Errata</h2>

<p>The materials appearing on Ah! D &amp; Dédé !’s Website may include technical, typographical, or photographic errors. Ah! D &amp; Dédé ! will not promise that any of the materials in this Website are accurate, complete, or current. Ah! D &amp; Dédé ! may change the materials contained on its Website at any time without notice. Ah! D &amp; Dédé ! does not make any commitment to update the materials.</p>

<h2>6. Links</h2>

<p>Ah! D &amp; Dédé ! has not reviewed all of the sites linked to its Website and is not responsible for the contents of any such linked site. The presence of any link does not imply endorsement by Ah! D &amp; Dédé ! of the site. The use of any linked website is at the user’s own risk.</p>

<h2>7. Site Terms of Use Modifications</h2>

<p>Ah! D &amp; Dédé ! may revise these Terms of Use for its Website at any time without prior notice. By using this Website, you are agreeing to be bound by the current version of these Terms and Conditions of Use.</p>

<h2>8. Your Privacy</h2>

<p>Please read our Privacy Policy.</p>

<h2>9. Governing Law</h2>

<p>Any claim related to Ah! D &amp; Dédé !\'s Website shall be governed by the laws of fr without regards to its conflict of law provisions.</p>
EOF
            )
            ->setType("legal")
            ->setIsActive(true)
            ->setMedia("cms2.jpg");
        $manager->persist($cms2);

        $cms3 = new CMS();
        $cms3->setTitle('Confidentialté & Cookies')
            ->setContent(
                <<<EOF
<p>
    Ah! D &amp; Dédé ! built the ADNDD app as
    a Free app. This SERVICE is provided by
    Ah! D &amp; Dédé ! at no cost and is intended for use as
    is.
</p> <p>
    This page is used to inform visitors regarding our
    policies with the collection, use, and disclosure of Personal
    Information if anyone decided to use our Service.
</p> <p>
    If you choose to use our Service, then you agree to
    the collection and use of information in relation to this
    policy. The Personal Information that we collect is
    used for providing and improving the Service. We will not use or share your information with
    anyone except as described in this Privacy Policy.
</p> <p>
    The terms used in this Privacy Policy have the same meanings
    as in our Terms and Conditions, which is accessible at
    ADNDD unless otherwise defined in this Privacy Policy.
</p>
<p>
    <strong>Information Collection and Use</strong>
</p> <p>
    For a better experience, while using our Service, we
    may require you to provide us with certain personally
    identifiable information, including but not limited to email, name. The information that
    we request will be retained by us and used as described in this privacy policy.
</p>
<div><p>
    The app does use third party services that may collect
    information used to identify you.
</p> <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----></ul>
</div>
<p>
    <strong>Log Data</strong>
</p> <p>
    We want to inform you that whenever you
    use our Service, in a case of an error in the app
    we collect data and information (through third party
    products) on your phone called Log Data. This Log Data may
    include information such as your device Internet Protocol
    (“IP”) address, device name, operating system version, the
    configuration of the app when utilizing our Service,
    the time and date of your use of the Service, and other
    statistics.
</p>
<p>
    <strong>Cookies</strong>
</p> <p>
    Cookies are files with a small amount of data that are
    commonly used as anonymous unique identifiers. These are sent
    to your browser from the websites that you visit and are
    stored on your device\'s internal memory.
</p> <p>
    This Service does not use these “cookies” explicitly. However,
    the app may use third party code and libraries that use
    “cookies” to collect information and improve their services.
    You have the option to either accept or refuse these cookies
    and know when a cookie is being sent to your device. If you
    choose to refuse our cookies, you may not be able to use some
    portions of this Service.
</p>
<p>
    <strong>Service Providers</strong>
</p> <p>
    We may employ third-party companies and
    individuals due to the following reasons:
</p> <p>
<ul>
    <li>To facilitate our Service;</li>
    <li>To provide the Service on our behalf;</li>
    <li>To perform Service-related services; or</li>
    <li>To assist us in analyzing how our Service is used.</li>
</ul> </p><p>
    We want to inform users of this Service
    that these third parties have access to your Personal
    Information. The reason is to perform the tasks assigned to
    them on our behalf. However, they are obligated not to
    disclose or use the information for any other purpose.
</p>
<p>
    <strong>Security</strong>
</p> <p>
    We value your trust in providing us your
    Personal Information, thus we are striving to use commercially
    acceptable means of protecting it. But remember that no method
    of transmission over the internet, or method of electronic
    storage is 100% secure and reliable, and we cannot
    guarantee its absolute security.
</p>
<p>
    <strong>Links to Other Sites</strong>
</p> <p>
    This Service may contain links to other sites. If you click on
    a third-party link, you will be directed to that site. Note
    that these external sites are not operated by us.
    Therefore, we strongly advise you to review the
    Privacy Policy of these websites. We have
    no control over and assume no responsibility for the content,
    privacy policies, or practices of any third-party sites or
    services.
</p>
<p>
    <strong>Children’s Privacy</strong>
</p> <p>
    These Services do not address anyone under the age of 13.
    We do not knowingly collect personally
    identifiable information from children under 13 years of age. In the case
    we discover that a child under 13 has provided
    us with personal information, we immediately
    delete this from our servers. If you are a parent or guardian
    and you are aware that your child has provided us with
    personal information, please contact us so that
    we will be able to do necessary actions.
</p>
<p>
    <strong>Changes to This Privacy Policy</strong>
</p> <p>
    We may update our Privacy Policy from
    time to time. Thus, you are advised to review this page
    periodically for any changes. We will
    notify you of any changes by posting the new Privacy Policy on
    this page.
</p> <p>This policy is effective as of 2021-07-01</p>
<p>
    <strong>Contact Us</strong>
</p> <p>
    If you have any questions or suggestions about our
    Privacy Policy, do not hesitate to contact us at contact@adndd.fr.</p>
EOF
            )
            ->setType("legal")
            ->setIsActive(true)
            ->setMedia("cms3.jpg");
        $manager->persist($cms3);

        $cms4 = new CMS();
        $cms4->setTitle('Qui sommes-nous ?')
            ->setContent(
                <<<EOF
<p> L'association “Ah ! D & Dédé !” est un club de jeu de rôles qui existe depuis septembre 2018, sous la forme d’une association loi 1901. La majorité des jeux couverts par l’association sont des jeux de rôles sur table appartenant en grande partie à ses membres. Elle propose également quelques jeux de société qu\'elle possède.</p>
<img src="/assets/images/association/association1.jpg" alt="image de association 1" />
<p> Située au coeur de la ville de Guéret dans la Creuse, elle réunit une vingtaine de membres réguliers qui vivent des aventures imaginaires de façon hebdomadaire, parfois lors de sessions uniques, mais aussi sous forme de grandes campagnes de jeu tel que le célèbre Donjons et Dragons.</p>
<img src="/assets/images/association/association2.jpg" alt="image de association 2" />
<p> Nous sommes une bande d\'amis amateurs du lancé de dés et de belles histoires, tantôt angoissantes, tantôt comiques, d\'aventures sérieuses ou farfelues qui aimont se retrouver autour d\'une table pour partager de bons moments, sans oublier pizza et sodas en tous genres !</p>
EOF
            )
            ->setType("about")
            ->setIsActive(true)
            ->setMedia("cms4.jpg");
        $manager->persist($cms4);

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
