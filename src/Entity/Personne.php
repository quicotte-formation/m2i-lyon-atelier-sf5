<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonneRepository::class)
 */
class Personne
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
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity=Film::class, mappedBy="acteurs")
     */
    private $filmsInterpretes;

    /**
     * @ORM\ManyToMany(targetEntity=Film::class, mappedBy="realisateurs")
     */
    private $filmsRealises;

    /**
     * @ORM\ManyToMany(targetEntity=Serie::class, mappedBy="acteurs")
     */
    private $seriesInterpretees;

    /**
     * @ORM\ManyToMany(targetEntity=Serie::class, mappedBy="realisateurs")
     */
    private $seriesRealisees;

    public function __construct()
    {
        $this->filmsInterpretes = new ArrayCollection();
        $this->filmsRealises = new ArrayCollection();
        $this->seriesInterpretees = new ArrayCollection();
        $this->seriesRealisees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Film[]
     */
    public function getFilmsInterpretes(): Collection
    {
        return $this->filmsInterpretes;
    }

    public function addFilmsInterprete(Film $filmsInterprete): self
    {
        if (!$this->filmsInterpretes->contains($filmsInterprete)) {
            $this->filmsInterpretes[] = $filmsInterprete;
            $filmsInterprete->addActeur($this);
        }

        return $this;
    }

    public function removeFilmsInterprete(Film $filmsInterprete): self
    {
        if ($this->filmsInterpretes->contains($filmsInterprete)) {
            $this->filmsInterpretes->removeElement($filmsInterprete);
            $filmsInterprete->removeActeur($this);
        }

        return $this;
    }

    /**
     * @return Collection|Film[]
     */
    public function getFilmsRealises(): Collection
    {
        return $this->filmsRealises;
    }

    public function addFilmsRealise(Film $filmsRealise): self
    {
        if (!$this->filmsRealises->contains($filmsRealise)) {
            $this->filmsRealises[] = $filmsRealise;
            $filmsRealise->addRealisateur($this);
        }

        return $this;
    }

    public function removeFilmsRealise(Film $filmsRealise): self
    {
        if ($this->filmsRealises->contains($filmsRealise)) {
            $this->filmsRealises->removeElement($filmsRealise);
            $filmsRealise->removeRealisateur($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->prenom . " " . $this->nom;
    }

    /**
     * @return Collection|Serie[]
     */
    public function getSeriesInterpretees(): Collection
    {
        return $this->seriesInterpretees;
    }

    public function addSeriesInterpretee(Serie $seriesInterpretee): self
    {
        if (!$this->seriesInterpretees->contains($seriesInterpretee)) {
            $this->seriesInterpretees[] = $seriesInterpretee;
            $seriesInterpretee->addActeur($this);
        }

        return $this;
    }

    public function removeSeriesInterpretee(Serie $seriesInterpretee): self
    {
        if ($this->seriesInterpretees->contains($seriesInterpretee)) {
            $this->seriesInterpretees->removeElement($seriesInterpretee);
            $seriesInterpretee->removeActeur($this);
        }

        return $this;
    }

    /**
     * @return Collection|Serie[]
     */
    public function getSeriesRealisees(): Collection
    {
        return $this->seriesRealisees;
    }

    public function addSeriesRealisee(Serie $seriesRealisee): self
    {
        if (!$this->seriesRealisees->contains($seriesRealisee)) {
            $this->seriesRealisees[] = $seriesRealisee;
            $seriesRealisee->addRealisateur($this);
        }

        return $this;
    }

    public function removeSeriesRealisee(Serie $seriesRealisee): self
    {
        if ($this->seriesRealisees->contains($seriesRealisee)) {
            $this->seriesRealisees->removeElement($seriesRealisee);
            $seriesRealisee->removeRealisateur($this);
        }

        return $this;
    }
}
