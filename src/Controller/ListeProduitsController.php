<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Produit;
use App\Entity\Distributeur;
use App\Entity\Panier;
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

    #[Route('/ajoutPanier/{id}', name: 'ajoutPanier')]
    public function ajoutPanier(Request $request, EntityManagerInterface $entityManager, $id) : Response {

        $panierRepo = $entityManager->getRepository(Panier::class);
        $produitRepo = $entityManager->getRepository(Produit::class);

        $panierEle = $panierRepo->findOneBy(['id_produit' => $id]);
        $produitEle = $produitRepo->find($id);

        //Si le produit 
        if ($produitEle->isRupture() == true){

            $session = $request->getSession();
            $session->getFlashBag()->add('message', 'Impossible d\'ajouter un produit en rupture de stock');
            $session->set('statut', 'danger');

            return $this->redirect($this->generateUrl('liste'));
        }

        if ($panierEle != null){

            $panierEle->setNbProduit($panierEle->getNbProduit() + 1);
            $produitEle->setQuantite($produitEle->getQuantite() - 1);
        }
        else{

            $panier = new Panier();

            $panier->setIdProduit($produitEle);
            $panier->setNbProduit(1);
            $produitEle->setQuantite($produitEle->getQuantite() - 1);

            $entityManager->persist($panier);
        }

        $entityManager->flush();


        $panierRepo = $entityManager->getRepository(Panier::class);
        $panier = $panierRepo->findAll();
        
        return $this->render('liste_produits/panier.html.twig', [
            'panier' => $panier,
        ]);
    }

    #[Route('/panier', name: 'panier')]
    public function panier(EntityManagerInterface $entityManager){

        $panierRepo = $entityManager->getRepository(Panier::class);
        $panier = $panierRepo->findAll();
        
        return $this->render('liste_produits/panier.html.twig', [
            'panier' => $panier,
        ]);
    }
    
    #[Route('/viderPanier', name: 'viderPanier')]
    public function viderPanier(EntityManagerInterface $entityManager)
    {
        $panierRepo = $entityManager->getRepository(Panier::class);
        $panierItems = $panierRepo->findAll();

        foreach ($panierItems as $panierItem) {
            $produit = $panierItem->getIdProduit();
            $quantite = $panierItem->getNbProduit();
            $produit->setQuantite($produit->getQuantite() + $quantite);
            $entityManager->remove($panierItem);
        }

        $entityManager->flush();

        return $this->redirectToRoute('panier');
        
    }
}
