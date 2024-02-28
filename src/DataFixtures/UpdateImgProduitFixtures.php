<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Data\ListeProduits;
use App\Entity\Produit;

class UpdateImgProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $repoProduit = $manager->getRepository(Produit::class);
        $listeProduits = $repoProduit->findAll();

        foreach ($listeProduits as $monproduit){

            switch($monproduit->getNom()){

                case 'imprimantes' : 
                    $monproduit->setLienImage('imprimante.jpg');
                    break;
                case 'cartouches encre' : 
                    $monproduit->setLienImage('cartoucheEncre.jpg');
                    break;
                case 'ordinateurs' : 
                    $monproduit->setLienImage('ordinateur.jpg');
                    break;
                case 'écrans' : 
                    $monproduit->setLienImage('ecran.jpg');
                    break;
                case 'claviers' : 
                    $monproduit->setLienImage('clavier.jpg');
                    break;
                case 'souris' : 
                    $monproduit->setLienImage('souris.jpg');
                    break;    
            }
            
        
            $manager->persist($monproduit);
        }

        $manager->flush();
    }
}
