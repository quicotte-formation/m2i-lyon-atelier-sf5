<?php

namespace App\Controller;

use App\DTO\InscriptionDTO;
use App\Form\InscriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ValidationFormController extends AbstractController
{
    /**
     * @Route("/validation")
     */
    public function validation(Request $req){

        $dto = new InscriptionDTO();
        $form = $this->createForm( InscriptionType::class, $dto );
        $form->handleRequest( $req );

        if( $form->isSubmitted() && $form->isValid() ){
            return $this->json("OK");
        }

        return $this->render('validation_form/index.html.twig', [
            'monForm'=>$form->createView()
        ]);
    }
}
