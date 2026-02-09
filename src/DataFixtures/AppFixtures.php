<?php

namespace App\DataFixtures;

use App\Entity\Chapitre;
use App\Entity\Cours;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Categorie;
use App\Entity\Niveau;
use App\Entity\Correction;
use App\Entity\Exercice;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $categorie = [];
        for($i=0; $i < 5; $i++)
        {
            $categori = new Categorie();
            $categori->setNom($faker->unique()->name());

            $manager->persist($categori);
            $categorie[] = $categori;
        }

        $niveau = [];
        for($i=0; $i <3; $i++)
        {
            $niveaux = new Niveau();
            $niveaux->setNom($faker->unique()->name); 

            $manager->persist($niveaux);
            $niveau[] = $niveaux;
        }

        for($i=0; $i<30; $i++)
        {
            $cours = new Cours();
            
            $niveaux = $niveau[array_rand($niveau)];
            $categori = $categorie[array_rand($categorie)];

            $cours->setNiveau($niveaux);
            $cours->setCategorie($categori);
            
            $manager->persist($cours);
        }

        $chapitres = [];
        for($i=0; $i<10; $i++)
        {
            $chapitre = new Chapitre();
            $chapitre->setTitle($faker->sentence(mt_rand(3,8)));
            $chapitre->setSousTitre($faker->sentence(mt_rand(3,8)));
            $chapitre->setDetail($faker->paragraph(mt_rand(3,6), true));
            $chapitre->setDate($faker->dateTimeBetween('-2 years', 'now'));

            $categori = $categorie[array_rand($categorie)];

            $chapitre->setCategorie($categori);

            $manager->persist($chapitre);
            $chapitres[] = $chapitre;
        }

        $corrections = [];
        for($i=0; $i<10; $i++)
        {
            $correction = new Correction();
            $correction->setName($faker->sentence(mt_rand(3,8)));
            $correction->setQuestion($faker->sentence(mt_rand(3,8)));
            $correction->setContenue($faker->paragraph(mt_rand(3,6), true));
            $correction->setDate($faker->dateTimeBetween('-2 years', 'now'));

            $manager->persist($correction);
            $corrections[] = $correction;
        }

        for($i=0; $i<10; $i++)
        {
            $exercice = new Exercice();
            $exercice->setNom($faker->sentence(mt_rand(3,8)));
            $exercice->setDescription($faker->paragraph(mt_rand(3,6), true));
            $exercice->setDate($faker->dateTimeBetween('-2 years', 'now'));

            $chapitre = $chapitres[array_rand($chapitres)];
            $correction = $corrections[array_rand($corrections)];

            $exercice->setChapitre($chapitre);
            $exercice->setCorrection($correction);

            $manager->persist($exercice);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
