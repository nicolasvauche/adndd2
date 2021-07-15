<?php

namespace App\DataFixtures;

use App\Entity\Config;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ConfigFixtures
    extends Fixture
    implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        /*
         * Application options fixtures
         */
        $optionsConfig = [
            'app_name' => 'Ah ! D & Dédé',
            'app_title' => 'Association creusoise de jeux de rôles',
            'app_author' => 'Nous',
            'app_email' => 'bonjour@dynaidev.com',
            'app_locale' => 'fr',
            'app_version' => '1.0',
        ];
        foreach ($optionsConfig as $optionName => $optionValue) {
            $config = new Config();
            $config->setName($optionName)
                ->setValue($optionValue);
            $manager->persist($config);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
