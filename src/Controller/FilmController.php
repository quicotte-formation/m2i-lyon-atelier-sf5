<?php

namespace App\Controller;

use App\DTO\RechercheFilmSerieAdminDTO;
use App\Entity\Film;
use App\Form\FilmType;
use App\Form\RechercheFilmSerieAdminType;
use App\Repository\FilmRepository;
use App\Service\JournalisationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/film")
 */
class FilmController extends AbstractController
{
    /**
     * @Route("/", name="film_index", methods={"GET", "POST"})
     */
    public function index(FilmRepository $filmRepository, Request $request): Response
    {
        $dto = new RechercheFilmSerieAdminDTO();
        $form = $this->createForm( RechercheFilmSerieAdminType::class, $dto );
        $form->handleRequest( $request );


        if( $form->isSubmitted() ){
            $films = $filmRepository->rechercherParTitreGenrePays( $dto->getTitre(), $dto->getGenre(), $dto->getPays() );
        }else{
            $films = $filmRepository->findAll();
        }

        return $this->render('film/index.html.twig', [
            'films' => $films,
            'formRecherche'=>$form->createView()
        ]);
    }

    /**
     * @Route("/new", name="film_new", methods={"GET","POST"})
     */
    public function new(Request $request, JournalisationService $service): Response
    {
        $film = new Film();
        $form = $this->createForm(FilmType::class, $film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($film);
            $entityManager->flush();

            $service->journaliser( "Ajout d'un nouveau film : " . $film->getTitre() );

            return $this->redirectToRoute('film_index');
        }

        return $this->render('film/new.html.twig', [
            'film' => $film,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="film_show", methods={"GET"})
     */
    public function show(Film $film): Response
    {
        return $this->render('film/show.html.twig', [
            'film' => $film,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="film_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Film $film): Response
    {
        $form = $this->createForm(FilmType::class, $film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('film_index');
        }

        return $this->render('film/edit.html.twig', [
            'film' => $film,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="film_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Film $film): Response
    {
        if ($this->isCsrfTokenValid('delete'.$film->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($film);
            $entityManager->flush();
        }

        return $this->redirectToRoute('film_index');
    }
}
