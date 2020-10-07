<?php

namespace App\DTO;

class FilmEtLiensDTO
{
    private $titre;
    private $annee;
    private $duree;
    private $nbLiens;
    private $genre;
    private $acteurs;
    private $realisateurs;
    private $pays;

    /**
     * @return mixed
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * @param mixed $pays
     */
    public function setPays($pays): void
    {
        $this->pays = $pays;
    }



    /**
     * @return mixed
     */
    public function getActeurs()
    {
        return $this->acteurs;
    }

    /**
     * @param mixed $acteurs
     */
    public function setActeurs($acteurs): void
    {
        $this->acteurs = $acteurs;
    }

    /**
     * @return mixed
     */
    public function getRealisateurs()
    {
        return $this->realisateurs;
    }

    /**
     * @param mixed $realisateurs
     */
    public function setRealisateurs($realisateurs): void
    {
        $this->realisateurs = $realisateurs;
    }



    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre): void
    {
        $this->genre = $genre;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * @param mixed $annee
     */
    public function setAnnee($annee): void
    {
        $this->annee = $annee;
    }

    /**
     * @return mixed
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param mixed $duree
     */
    public function setDuree($duree): void
    {
        $this->duree = $duree;
    }

    /**
     * @return mixed
     */
    public function getNbLiens()
    {
        return $this->nbLiens;
    }

    /**
     * @param mixed $nbLiens
     */
    public function setNbLiens($nbLiens): void
    {
        $this->nbLiens = $nbLiens;
    }


}