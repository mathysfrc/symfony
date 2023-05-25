<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        ['title' => 'Walking Dead',
        'synopsis' => 'Des zombies envahissent la terre',
        'category' => 'category_Horreur',
        'poster' => 'Photo',
        'country' => 'États-Unis',
        'year' => 2010,
        ],

        ['title' => 'Deadpool',
        'synopsis' => 'Sauver le monde est son objectif',
        'category' => 'category_Action',
        'poster' => 'Photo',
        'country' => 'Canada',
        'year' => 	2016,],

        ['title' => 'Bisounours',
        'synopsis' => 'La ou le monde va pour le mieux',
        'category' => 'category_Fantastique',
        'poster' => 'Photo',
        'country' => 'France',
        'year' => 1985,],

        ['title' => 'Uncharted',
        'synopsis' => 'La vie du célèbre chasseur de trésor',
        'category' => 'category_Aventure',
        'poster' => 'Photo',
        'country' => 'États-Unis',
        'year' => 2022,],

        ['title' => 'Encanto',
        'synopsis' => 'La maison enchantée de Colombie',
        'category' => 'category_Animation',
        'poster' => 'Photo',
        'country' => 'Colombie',
        'year' => 2021,],

    ];

    public function load(ObjectManager $manager)
    {
        $i = 0;

        foreach (self::PROGRAMS as $key => $programData){
            $program = new Program();
            $program->setTitle($programData['title']);
            $program->setSynopsis($programData['synopsis']);
            $program->setCategory($this->getReference($programData['category']));
            $program->setPoster($programData['poster']);
            $program->setCountry($programData['country']);
            $program->setYear($programData['year']);
            $manager->persist($program);
            $this->addReference('program_' . $i, $program);
            $i++;
        }
        $manager->flush();
    }

    

    public function getDependencies()
    {
        return [
          CategoryFixtures::class,
        ];
    }


}