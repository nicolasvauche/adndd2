<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures
    extends Fixture
    implements OrderedFixtureInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // Administrator account
        $user = new User();
        $user->setRegisterId('0123456789')
            ->setFirstName('Nicolas')
            ->setLastName('Vauché')
            ->setPseudo('nicolasvauche')
            ->setEmail('nvauche@gmail.com')
            ->setPassword($this->encoder->encodePassword($user, 'nicolas'))
            ->setRoles(['ROLE_ADMIN'])
            ->setIsActive(true)
            ->setActivatedAt(new \DateTime());
        $manager->persist($user);

        // Player account
        $matt = new User();
        $matt->setRegisterId('1123756785')
            ->setFirstName('Matt')
            ->setLastName('Co')
            ->setPseudo('Lord Aixois')
            ->setEmail('87700a@gmail.com')
            ->setPassword($this->encoder->encodePassword($matt, 'matthieu'))
            ->setRoles(['ROLE_USER'])
            ->setIsActive(true)
            ->setActivatedAt(new \DateTime());
        $manager->persist($matt);

        // Guest account
        $dom = new User();
        $dom->setRegisterId('2523446789')
            ->setFirstName('Dominique')
            ->setLastName('')
            ->setPseudo('Dom')
            ->setEmail('dom@hotmail.com')
            ->setPassword($this->encoder->encodePassword($dom, 'dom'))
            ->setRoles(['ROLE_USER'])
            ->setIsActive(true);
        $manager->persist($dom);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
