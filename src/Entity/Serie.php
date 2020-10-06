<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SerieRepository::class)
 */
class Serie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $synopsis;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    /**
     * @ORM\OneToMany(targetEntity=Saison::class, mappedBy="serie")
     */
    private $saisons;

    /**
     * @ORM\ManyToOne(targetEntity=Genre::class, inversedBy="series")
     */
    private $genre;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="series")
     */
    private $pays;

    /**
     * @ORM\ManyToMany(targetEntity=Personne::class, inversedBy="seriesInterpretees")
     * @ORM\JoinTable(name="serie_interprete")
     */
    private $acteurs;

    /**
     * @ORM\ManyToMany(targetEntity=Personne::class, inversedBy="seriesRealisees")
     * @ORM\JoinTable(name="serie_real")
     */
    private $realisateurs;

    public function __construct()
    {
        $this->acteurs = new ArrayCollection();
        $this->realisateurs = new ArrayCollection();
        $this->saisons = new ArrayCollection();
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection|Personne[]
     */
    public function getActeurs(): Collection
    {
        return $this->acteurs;
    }

    public function addActeur(Personne $acteur): self
    {
        if (!$this->acteurs->contains($acteur)) {
            $this->acteurs[] = $acteur;
        }

        return $this;
    }

    public function removeActeur(Personne $acteur): self
    {
        if ($this->acteurs->contains($acteur)) {
            $this->acteurs->removeElement($acteur);
        }

        return $this;
    }

    /**
     * @return Collection|Personne[]
     */
    public function getRealisateurs(): Collection
    {
        return $this->realisateurs;
    }

    public function addRealisateur(Personne $realisateur): self
    {
        if (!$this->realisateurs->contains($realisateur)) {
            $this->realisateurs[] = $realisateur;
        }

        return $this;
    }

    public function removeRealisateur(Personne $realisateur): self
    {
        if ($this->realisateurs->contains($realisateur)) {
            $this->realisateurs->removeElement($realisateur);
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * @return Collection|Saison[]
     */
    public function getSaisons(): Collection
    {
        return $this->saisons;
    }

    public function addSaison(Saison $saison): self
    {
        if (!$this->saisons->contains($saison)) {
            $this->saisons[] = $saison;
            $saison->setSerie($this);
        }

        return $this;
    }

    public function removeSaison(Saison $saison): self
    {
        if ($this->saisons->contains($saison)) {
            $this->saisons->removeElement($saison);
            // set the owning side to null (unless already changed)
            if ($saison->getSerie() === $this) {
                $saison->setSerie(null);
            }
        }

        return $this;
    }


}
