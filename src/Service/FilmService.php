<?php


namespace App\Service;


use App\Entity\Film;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;

class FilmService
{
    private $filmRep;
    private $em;

    public function __construct(FilmRepository $filmRepository, EntityManagerInterface $em)
    {
        $this->filmRep = $filmRepository;
        $this->em = $em;
    }

    public function rechercherTous(){

        return $this->filmRep->findAll();
    }

    public function rechercheMulticriteres($titre, $genre, $pays, $acteur, $real, $annee){

        return $this->filmRep->rechercheMulticriteresVisiteur($titre, $genre, $pays, $acteur, $real, $annee);
    }

    public function rechercheMulticriteres2(){

        $this->filmRep->findAll();
    }
}