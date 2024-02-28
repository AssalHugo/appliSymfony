<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class RedirectionController extends AbstractController {
    #[Route('/redir', name: 'redir')]
    public function index(Request $request): Response
    {

        $session = $request->getSession();
        $session->getFlashBag()->add('info', 'message 1');
        $session->getFlashBag()->add('info', 'message 2');

        $url = $this->generateUrl('redirection');

        return $this->redirect($url);
    }
    
    #[Route('/redirection', name: 'redirection')]
    public function redirection(Request $request): Response{

        $session = $request->getSession();
        $info = $session->getFlashBag()->get('info');

        $rep = '';

        foreach($info as $message){

            $rep .= $message .' <br>';
        }
        return new Response("message : $rep");
    }

}
