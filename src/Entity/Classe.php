<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $niveau = null;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: Cours::class)]
    private Collection $courss;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->courss = new ArrayCollection();
        $this->users = new ArrayCollection();
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

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCourss(): Collection
    {
        return $this->courss;
    }

    public function addCourss(Cours $courss): static
    {
        if (!$this->courss->contains($courss)) {
            $this->courss->add($courss);
            $courss->setClasse($this);
        }

        return $this;
    }

    public function removeCourss(Cours $courss): static
    {
        if ($this->courss->removeElement($courss)) {
            // set the owning side to null (unless already changed)
            if ($courss->getClasse() === $this) {
                $courss->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setClasse($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getClasse() === $this) {
                $user->setClasse(null);
            }
        }

        return $this;
    }
}
