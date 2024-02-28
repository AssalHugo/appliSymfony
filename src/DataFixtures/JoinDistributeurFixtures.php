<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use App\Data\ListeProduits;
use App\Entity\Produit;
use App\Entity\Distributeur;

class JoinDistributeurFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $repoProduit = $manager->getRepository(Produit::class);
        
        $logitech  = new Distributeur();
        $logitech->setNom('logitech');
        $hp = new Distributeur();
        $hp->setNom('HP');
        $epson = new Distributeur();
        $epson->setNom('EPSON');
        $dell = new Distributeur();
        $dell->setNom('Dell');
        $acer = new Distributeur();
        $acer->setNom('ACER');

        //jointures
        $produit = $repoProduit->findOneBy(array('nom' => 'souris'));
        $produit->addDistributeur($hp);
        $produit->addDistributeur($logitech);

        $produit = $repoProduit->findOneBy(array('nom' => 'écrans'));
        $produit->addDistributeur($hp);
        $produit->addDistributeur($dell);

        $produit = $repoProduit->findOneBy(array('nom' => 'claviers'));
        $produit->addDistributeur($hp);
        $produit->addDistributeur($dell);
        $produit->addDistributeur($acer);

        $produit = $repoProduit->findOneBy(array('nom' => 'ordinateurs'));
        $produit->addDistributeur($epson);

        $produit = $repoProduit->findOneBy(array('nom' => 'cartouches encre'));
        $produit->addDistributeur($hp);
        $produit->addDistributeur($epson);

        $produit = $repoProduit->findOneBy(array('nom' => 'imprimantes'));
        $produit->addDistributeur($epson);
        $produit->addDistributeur($logitech);

        $manager->persist($produit);


        $manager->flush();
    }

    public static function getGroups() : array{

        return ['group3'];
    }
}
