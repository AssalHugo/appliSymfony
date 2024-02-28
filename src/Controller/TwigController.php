<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TwigController extends AbstractController
{
    #[Route('/twig', name: 'twig')]
    public function index(Request $request): Response
    {

        $session = $request->getSession();
        $session->getFlashBag()->add('message', 'message informatif');
        $session->getFlashBag()->add('message', 'message complémentaire');
        $session->set('statut', 'primary');

        $age = random_int(30, 90);

        return $this->render('test/age.html.twig', [
            'controller_name' => 'TwigController',
            'age' => $age
        ]);
    }
}
