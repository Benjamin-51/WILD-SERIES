<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAM = [
        'The Big Bang Theory',
        'Foxes in love',
        'Duncan & Eddit',
    ];
    public function load(ObjectManager $manager): void
    {
        /*foreach (self::PROGRAMS as $key => $programName) {
            $program = new Program();
            $program->setTitle($programName);
            $manager->persist($program);
            $this->addReference('program_' . $key, $program);
        }*/
        $program = new Program();
        $program->setTitle('Walking dead');
        $program->setSummary('Des zombies envahissent la terre');
        $program->setCountry('lol');
        $program->setYear(1);
        $program->setCategory($this->getReference('category_0'));
        //ici les acteurs sont insérés via une boucle pour être DRY mais ce n'est pas obligatoire
        for ($i=0; $i < count(ActorFixtures::ACTORS); $i++) {
            $program->addActor($this->getReference('actor_' . $i));
        }

        $manager->persist($program);
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          ActorFixtures::class,
          CategoryFixtures::class,
        ];
    }
}
