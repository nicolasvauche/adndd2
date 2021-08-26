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
        $this->addReference('user1', $user);

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
        $this->addReference('user2', $matt);

        $julien = new User();
        $julien->setRegisterId('1123785')
            ->setFirstName('Julien')
            ->setLastName('Vasse')
            ->setPseudo('Icar45')
            ->setEmail('julien.vasse87@outlook.fr')
            ->setPassword($this->encoder->encodePassword($julien, 'julien'))
            ->setRoles(['ROLE_USER'])
            ->setIsActive(true)
            ->setGender('Mr')
            ->setActivatedAt(new \DateTime());
        $manager->persist($julien);
        $this->addReference('user3', $julien);

        // Guest account
        $dom = new User();
        $dom->setFirstName('Dominique')
            ->setLastName('')
            ->setPseudo('Dom')
            ->setEmail('dom@hotmail.com')
            ->setPassword($this->encoder->encodePassword($dom, 'dom'))
            ->setRoles(['ROLE_USER'])
            ->setIsActive(true);
        $manager->persist($dom);
        $this->addReference('user4', $dom);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
