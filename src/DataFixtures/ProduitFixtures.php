<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Data\ListeProduits;
use App\Entity\Produit;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        foreach (ListeProduits::$mesproduits as $monproduit){

            $produit = new Produit();

            $produit->setNom($monproduit['nom']);
            $produit->setPrix($monproduit['prix']);
            $produit->setQuantite($monproduit['quantite']);
            $produit->setRupture($monproduit['rupture']);
            
        
            $manager->persist($produit);
        }



        $manager->flush();
    }
}
