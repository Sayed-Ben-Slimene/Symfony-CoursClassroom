<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $fichier = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'cours')]
    private Collection $personne;

    #[ORM\ManyToOne(inversedBy: 'courss')]
    private ?Classe $classe = null;

    public function __construct()
    {
        $this->personne = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getFichier(): ?string
    {
        return $this->fichier;
    }

    public function setFichier(string $fichier): static
    {
        $this->fichier = $fichier;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getPersonne(): Collection
    {
        return $this->personne;
    }

    public function addPersonne(User $personne): static
    {
        if (!$this->personne->contains($personne)) {
            $this->personne->add($personne);
        }

        return $this;
    }

    public function removePersonne(User $personne): static
    {
        $this->personne->removeElement($personne);

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): static
    {
        $this->classe = $classe;

        return $this;
    }
}
