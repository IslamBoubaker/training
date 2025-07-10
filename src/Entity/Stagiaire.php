<?php

namespace App\Entity;

use App\Repository\StagiaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StagiaireRepository::class)]
class Stagiaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    /**
     * @var Collection<int, Inscription>
     */
    #[ORM\OneToMany(targetEntity: Inscription::class, mappedBy: 'stagiaire')]
    private Collection $inscriptions;

    /**
     * @var Collection<int, FichePresence>
     */
    #[ORM\OneToMany(targetEntity: FichePresence::class, mappedBy: 'stagiaire')]
    private Collection $fichePresences;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->fichePresences = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): static
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions->add($inscription);
            $inscription->setStagiaire($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getStagiaire() === $this) {
                $inscription->setStagiaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FichePresence>
     */
    public function getFichePresences(): Collection
    {
        return $this->fichePresences;
    }

    public function addFichePresence(FichePresence $fichePresence): static
    {
        if (!$this->fichePresences->contains($fichePresence)) {
            $this->fichePresences->add($fichePresence);
            $fichePresence->setStagiaire($this);
        }

        return $this;
    }

    public function removeFichePresence(FichePresence $fichePresence): static
    {
        if ($this->fichePresences->removeElement($fichePresence)) {
            // set the owning side to null (unless already changed)
            if ($fichePresence->getStagiaire() === $this) {
                $fichePresence->setStagiaire(null);
            }
        }

        return $this;
    }
}
