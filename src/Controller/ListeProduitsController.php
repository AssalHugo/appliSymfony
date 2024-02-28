<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;

class ListeProduitsController extends AbstractController
{
    #[Route('/liste', name: 'liste')]
    public function liste(EntityManagerInterface $entityManager): Response
    {

        $produitsRepository = $entityManager->getRepository(Produit::class);

        $listeProduits = $produitsRepository->orderingProduit();

        return $this->render('liste_produits/index.html.twig', [
            'listeProduits' => $listeProduits,
        ]);
    }
}
