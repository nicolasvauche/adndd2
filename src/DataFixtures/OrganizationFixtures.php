<?php

namespace App\DataFixtures;

use App\Entity\Organization;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class OrganizationFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $org = new Organization();
        $org->setTelephone('+33 1 23 45 67 89')
            ->setAddress1('22 avenue de la Sénatorerie')
            ->setZipcode('23000')
            ->setCity('Guéret')
            ->setCountry('France')
            ->setFacebook('https://www.facebook.com')
            ->setTwitter('https://www.twitter.com')
            ->setInstagram('https://www.instagram.com')
            ->setYoutube('https://www.youtube.com')
            ->setHoursWeek('18h00 - 00h00')
            ->setHoursWeekend('14h00 - 00h00');
        $manager->persist($org);

        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}

