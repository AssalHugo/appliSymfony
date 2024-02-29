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

class AdminController extends AbstractController
{
    #[Route('/insert', name: 'app_admin')]
    public function insert(Request $request): Response
    {

        $form = $this->createFormBuilder(null, ['action' => '/insert', 'method' => 'POST',])->add('nom', TextType::class)->add('date', DateType::class)->add('save', SubmitType::class, ['label' => 'Insérer un produit'])->getForm();

        if($request->isMethod('POST')){

            return new JsonResponse($request->request->all());
        }

        return $this->render('Admin/create.html.twig', ['my_form' => $form->createView()]);
    }

    #[Route("/update/{id}", name:"update")]
    public function update(Request $request, $id){

        return $this->render('Admin/create.html.twig');
    }

    #[Route("/delete/{id}", name:"delete")]
    public function delete(Request $request, $id){

        
    }
}