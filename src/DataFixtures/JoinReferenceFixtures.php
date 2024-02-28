<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use App\Data\ListeProduits;
use App\Entity\Produit;
use App\Entity\Reference;

class JoinReferenceFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $repoProduit = $manager->getRepository(Produit::class);
        $listeProduits = $repoProduit->findAll();

        foreach ($listeProduits as $monproduit){

            $ref = new Reference();

            $ref->setNumero(rand());
            
            $monproduit->setReference($ref);
            $manager->persist($monproduit);
        }

        $manager->flush();
    }

    public static function getGroups() : array{

        return ['group2'];
    }
}
