<?php

namespace App\Controller;

use App\DTO\RechercheFilmSerieVisiteurDTO;
use App\Form\RechercheFilmSerieVisiteurType;
use App\Repository\FilmRepository;
use App\Service\FilmService;
use App\Service\FilmService2;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FilmVisiteurController extends AbstractController
{
    /**
     * @Route("/film-visiteur-enfants")
     */
    public function listerFilmsEnfants(FilmService2 $service){
        dump( $service->listerFilmsEnfant() );
    }

    /**
     * @Route("/film-visiteur-detail/{idFilm}", name="film-visiteur-detail")
     */
    public function detail($idFilm, FilmRepository $filmRepository)
    {

        $film = $filmRepository->find($idFilm);

        return $this->render("film_visiteur/detail.html.twig", ['film' => $film]);
    }

    /**
     * @Route("/film-visiteur-liste", name="film-visiteur-liste")
     */
    public function liste(FilmService $service, Request $request)
    {
        $dto = new RechercheFilmSerieVisiteurDTO();
        $form = $this->createForm(RechercheFilmSerieVisiteurType::class, $dto);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $films = $service->rechercheMulticriteres($dto->getTitre(), $dto->getGenre(),
                $dto->getPays(), $dto->getActeur(), $dto->getReal(), $dto->getAnnee());
        } else {
            $films = $service->rechercherTous();
        }

        return $this->render('film_visiteur/liste.html.twig', [
            'formRecherche' => $form->createView(),
            'films' => $films
        ]);
    }
}
