<?php


namespace App\DTO;


class AjoutSerieDTO
{
    private $titre;
    private $annee;
    private $nbSaison;
    private $nbEpisodes;

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
    public function getNbSaison()
    {
        return $this->nbSaison;
    }

    /**
     * @param mixed $nbSaison
     */
    public function setNbSaison($nbSaison): void
    {
        $this->nbSaison = $nbSaison;
    }

    /**
     * @return mixed
     */
    public function getNbEpisodes()
    {
        return $this->nbEpisodes;
    }

    /**
     * @param mixed $nbEpisodes
     */
    public function setNbEpisodes($nbEpisodes): void
    {
        $this->nbEpisodes = $nbEpisodes;
    }


}