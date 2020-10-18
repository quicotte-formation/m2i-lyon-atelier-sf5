<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CookiesEtSessionsController extends AbstractController
{
    /**
     * @Route("/sessions")
     */
    public function session(Request $req){

        $req->getSession()->set("pannier", [1,3,5,7]);
        $req->getSession()->set("categorie-consultee", "hi-fi");
        $req->getSession()->set("dernier-prod-consulte", "casque bluetooth");


        return $this->render('cookies_et_sessions/index.html.twig', [
            'controller_name' => 'CookiesEtSessionsController',
        ]);
    }

    /**
     * @Route("/cookies", name="cookies")
     */
    public function index(Request $req)
    {
        $req->cookies->set("categorie","hi-fi");

        return $this->render('cookies_et_sessions/index.html.twig', [
            'controller_name' => 'CookiesEtSessionsController',
        ]);
    }
}
