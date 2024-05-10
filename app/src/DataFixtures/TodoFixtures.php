<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Todo;
use Faker\Factory;


class TodoFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Tableau de noms prédéfinis
        $todoNames = [
            'Tâche 1',
            'Tâche 2',
            'Tâche 3',
            'Tâche 4',
            'Tâche 5',
            'Tâche 6',
            'Tâche 7',
            'Tâche 8',
            'Tâche 9',
            'Tâche 10'
        ];

        for ($i = 0; $i < 10; $i++) {
            $todo = new Todo();
            $todo->setName($todoNames[$i]); // Utilisation d'un nom prédéfini
            $todo->setDescription('Description pour ' . $todoNames[$i]);
            $todo->setDone(false); // Vous pouvez également choisir de mettre cela à vrai ou faux aléatoirement

            $manager->persist($todo);
        }

        $manager->flush();
    }
}
