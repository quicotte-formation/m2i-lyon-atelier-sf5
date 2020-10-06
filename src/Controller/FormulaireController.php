<?php

namespace App\Controller;

use App\Entity\Film;
use App\Form\TestType;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FormulaireController extends AbstractController
{
    /**
     * @Route("/formulaire", name="formulaire")
     */
    public function ajouterFilm(FilmRepository $rep, Request $req, EntityManagerInterface $em)
    {
        $dto = new Film();
        $form = $this->createForm(TestType::class, $dto);
        $form->handleRequest($req);
        if( $form->isSubmitted() ){
            $em->persist( $dto );
            $em->flush();

            return $this->redirectToRoute("film_index");
        }

        dump( $dto );


        return $this->render('formulaire/index.html.twig', ['monForm'=>$form->createView()]);
    }
}
