<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Episode;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface {

    const SEASON_NUMBER = 24;
    
    public function load(ObjectManager $manager)
    {
        //Puis ici nous demandons à la Factory de nous fournir un Faker
        $faker = Factory::create();

        /**
        * L'objet $faker que tu récupère est l'outil qui va te permettre 
        * de te générer toutes les données que tu souhaites
        */

        for($i = 0; $i < 100; $i++) {
            $episode = new Episode();
            //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
            $episode->setTitle($faker->words(3, true));

            $episode->setNumber($faker->numberBetween(1, 10));

            $episode->setSynopsis($faker->paragraphs(3, true));

            $episode->setSeason($this->getReference('season_' . $faker->numberBetween(0, 24)));

            $manager->persist($episode);
            
 
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          SeasonFixtures::class,
        ];
    }
}
