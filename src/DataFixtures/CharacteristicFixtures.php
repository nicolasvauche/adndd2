<?php

namespace App\DataFixtures;

use App\Entity\Characteristic;
use App\Entity\GameCharacteristic;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class CharacteristicFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /**
         * Default characteristic
         */
        $characteristics = [
            ["Modificateur aux dégâts", "DMG", null],
            ["Jet d'Idée", "JIDE", null],
            ["Jet de Chance", "JLUCK", null],
            ["Jet de Charisme", "JCHAR", null],
            ["Jet de Dexterité", "JDEX", null],
            ["Force", "FOR", 'characteristic'],
            ["Constitution", "CON", 'characteristic'],
            ["Taille", "TAI", 'characteristic'],
            ["Intelligence", "INT", 'characteristic'],
            ["Pouvoir", "POU", 'characteristic'],
            ["Dexterité", "DEX", 'characteristic'],
            ["Apparence", "APP", 'characteristic'],
            ["Point de vie", "HP", null],
        ];

        foreach ($characteristics as list($a, $b, $c)) {
            $characteristic = new Characteristic();
            $characteristic->setName($a)
                        ->setShortName($b)
                        ->setType($c);
            $manager->persist($characteristic);

            $gameCharacteristic = new GameCharacteristic();
            $gameCharacteristic->setGame($this->getReference('game1'))
                    ->setCharacteristic($characteristic)
                    ->setBase('50');
            $manager->persist( $gameCharacteristic );
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }
}
