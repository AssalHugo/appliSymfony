<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Produit;
use App\Form\ProduitType;
use Doctrine\ORM\EntityManagerInterface;


class AdminController extends AbstractController
{
    #[Route('/insert', name: 'app_admin')]
    public function insert(Request $request, EntityManagerInterface $entityManager): Response
    {

        $produit = new Produit();
        $formProduit = $this->createForm(ProduitType::class,$produit);

        $formProduit->add('creer', SubmitType::class, ['label' => 'Insertion d\'un produit']);

        $formProduit->handleRequest($request);

        if($request->isMethod('POST') && $formProduit->isValid()){

            $file = $formProduit['lienImage']->getData();

            //si une image est donnée
            if (!is_string($file)){

                $filename = $file->getClientOriginalName();
                $file->move($this->getParameter('images_directory'), $filename);

                $produit->setLienImage($filename);

                $entityManager->persist($produit);

                $entityManager->flush();

                return $this->redirect($this->generateUrl('liste'));
            }
            else{

                $session = $request->getSession();
                $session->getFlashBag()->add('message', 'Vous devez choisir une image pour le produit');
                $session->set('statut', 'danger');

                return $this->redirect($this->generateUrl('app_admin'));
            }
        }

        return $this->render('Admin/create.html.twig', ['my_form' => $formProduit->createView()]);
    }

    #[Route("/update/{id}", name:"update")]
    public function update(Request $request, $id){

        return $this->render('Admin/create.html.twig');
    }

    #[Route("/delete/{id}", name:"delete")]
    public function delete(Request $request, $id){

        
    }
}