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
        'category' => 'category_Horreur'],

        ['title' => 'Deadpool',
        'synopsis' => 'Sauver le monde est son objectif',
        'category' => 'category_Action'],

        ['title' => 'Bisounours',
        'synopsis' => 'La ou le monde va pour le mieux',
        'category' => 'category_Fantastique'],

        ['title' => 'Uncharted',
        'synopsis' => 'La vie du célèbre chasseur de trésor',
        'category' => 'category_Aventure'],

        ['title' => 'Encanto',
        'synopsis' => 'La maison enchantée de Colombie',
        'category' => 'category_Animation'],

    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $programData){
            $program = new Program();
            $program->setTitle($programData['title']);
            $program->setSynopsis($programData['synopsis']);
            $program->setCategory($this->getReference($programData['category']));
            $manager->persist($program);
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