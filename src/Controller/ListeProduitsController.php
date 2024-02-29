<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Produit;
use App\Entity\Distributeur;
use Doctrine\ORM\EntityManagerInterface;

class ListeProduitsController extends AbstractController
{
    #[Route('/liste', name: 'liste')]
    public function liste(EntityManagerInterface $entityManager): Response
    {

        $produitsRepository = $entityManager->getRepository(Produit::class);

        $listeProduits = $produitsRepository->findAll();
        $lastProduit = $produitsRepository->getLastProduit();

        return $this->render('liste_produits/index.html.twig', [
            'listeProduits' => $listeProduits,
            'lastProduit' =>$lastProduit,
        ]);
    }

    #[Route('/distrib', name: 'distributeurs')]
    public function listeDistributeur(EntityManagerInterface $entityManager): Response
    {

        $produitsRepository = $entityManager->getRepository(Distributeur::class);

        $distributeurs = $produitsRepository->findAll();

        return $this->render('liste_produits/distributeurs.html.twig', [
            'distributeurs' => $distributeurs,
        ]);
    }
}
