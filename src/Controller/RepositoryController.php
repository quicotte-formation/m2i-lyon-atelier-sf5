<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\Genre;
use App\Repository\FilmRepository;
use App\Repository\GenreRepository;
use App\Repository\InutileRepository;
use App\Repository\PaysRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RepositoryController extends AbstractController
{
    /**
     * @Route("/rechercherParActeur")
     */
    public function rechercherParActeur(FilmRepository $rep){
        dump( $rep->rechercherParActeur("Jet", "Li") );
    }

    /**
     * @Route("/rechercherGenreParTitreFilm")
     */
    public function rechercherGenreParTitreFilm(GenreRepository $rep){
        dump( $rep->rechercherGenreParTitreFilm("Tigre et Dragons") );
    }

    /**
     * @Route("/rechercherGenreParNom")
     */
    public function rechercherGenreParNom(GenreRepository $rep){

        dump($rep->findByNom("Policier"));
    }

    /**
     * @Route("/rechercherFilmParTitreEtParGenre")
     */
    public function rechercherFilmParTitreEtParGenre(FilmRepository $rep){
        dump( $rep->rechercherFilmParTitreEtParGenre("Tigre et Dragons", "Policier") );
    }

    /**
     * @Route("/rechercherFilmsParTitre")
     */
    public function rechercherFilmsParTitre(FilmRepository $rep){

        dump( $rep->findByTitre("Tigre et Dragons") );
    }

    /**
     * @Route("/rechercherFilmsIdPlusGrandQue")
     */
    public function rechercherFilmsIdPlusGrandQue(FilmRepository $rep){
        dump( $rep->rechercherFilmsIdPlusGrandQue(1) );
    }

    /**
     * @Route("/rechercerFilmsParAnnee")
     */
    public function rechercerFilmsParAnnee(FilmRepository $rep){

        dump( $rep->findByAnneeSortie(2000) );
    }

    /**
     * @Route("/rep1")
     */
    public function rep1(FilmRepository $rep, GenreRepository $genreRep)
    {
        $films = $rep->rechercherParGenreEtPays('Policier', 'France');

        dump($films);
    }
}
