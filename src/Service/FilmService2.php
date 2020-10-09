<?php


namespace App\Service;


use App\Repository\FilmRepository;

class FilmService2
{
    private $filmRep;
    private $journalService;

    public function __construct(FilmRepository $rep, JournalisationService $journalService)
    {
        $this->filmRep = $rep;
        $this->journalService = $journalService;
    }

    /**
     * Les films enfant: titre / synopsis ne doit pas contenir le mot 'Dracula' ni le mot 'mortel'
     * Leur genre ne peut être ni Horreur ni Drame
     * Leur durée ne peut pas excéder 60 min
     * Leur réalisateur ne peut pas être Jet Li
     */
    public function listerFilmsEnfant(){

        $films = $this->filmRep->findAll();

        // Logique applicative, sélectionner uniquement les films enfant
        $filmsEnfants = [];

        foreach ($films as $film){

            if( strpos( $film->getTitre(), 'Dracula' )!==false ){
                continue;
            }
            if( strpos( $film->getSynopsis(), 'Dracula' )!==false ){
                continue;
            }
            if( strpos( $film->getGenre()->getNom(), 'Horreur' )!==false ||
                strpos( $film->getGenre()->getNom(), 'Drame' )!==false ){
                continue;
            }

            // Tts conditions sont ok pour enfants
            $filmsEnfants[] = $film;
        }

        $this->journalService->journaliser("listerFilmsEnfant");

        return $filmsEnfants;
    }
}