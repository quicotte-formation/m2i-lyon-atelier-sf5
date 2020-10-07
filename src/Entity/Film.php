<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FilmRepository::class)
 */
class Film
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $synopsis;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $anneeSortie;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

    /**
     * @ORM\ManyToOne(targetEntity=Genre::class, inversedBy="films")
     * @ORM\JoinColumn(nullable=false)
     */
    private $genre;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="films")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pays;

    /**
     * @ORM\ManyToMany(targetEntity=Personne::class, inversedBy="filmsInterpretes")
     * @ORM\JoinTable(name="films_acteurs")
     */
    private $acteurs;

    /**
     * @ORM\ManyToMany(targetEntity=Personne::class, inversedBy="filmsRealises")
     * @ORM\JoinTable(name="films_realisateurs")
     */
    private $realisateurs;

    /**
     * @ORM\OneToMany(targetEntity=Lien::class, mappedBy="film")
     */
    private $liens;

    /**
     * @param ArrayCollection $acteurs
     */
    public function setActeurs(ArrayCollection $acteurs): void
    {
        $this->acteurs = $acteurs;
    }

    /**
     * @param ArrayCollection $realisateurs
     */
    public function setRealisateurs(ArrayCollection $realisateurs): void
    {
        $this->realisateurs = $realisateurs;
    }

    public function __construct()
    {
        $this->acteurs = new ArrayCollection();
        $this->realisateurs = new ArrayCollection();
        $this->liens = new ArrayCollection();
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

    public function setSynopsis(?string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getAnneeSortie(): ?int
    {
        return $this->anneeSortie;
    }

    public function setAnneeSortie(?int $anneeSortie): self
    {
        $this->anneeSortie = $anneeSortie;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
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

    /**
     * @return Collection|Lien[]
     */
    public function getLiens(): Collection
    {
        return $this->liens;
    }

    public function addLien(Lien $lien): self
    {
        if (!$this->liens->contains($lien)) {
            $this->liens[] = $lien;
            $lien->setFilm($this);
        }

        return $this;
    }

    public function removeLien(Lien $lien): self
    {
        if ($this->liens->contains($lien)) {
            $this->liens->removeElement($lien);
            // set the owning side to null (unless already changed)
            if ($lien->getFilm() === $this) {
                $lien->setFilm(null);
            }
        }

        return $this;
    }
}
