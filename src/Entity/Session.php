<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $dateDebut = null;

    #[ORM\Column]
    private ?\DateTime $dateFin = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\Column]
    private ?int $nombreMinParticipants = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    private ?Formation $formation = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    private ?Formateur $formateur = null;

    /**
     * @var Collection<int, Inscription>
     */
    #[ORM\OneToMany(targetEntity: Inscription::class, mappedBy: 'session')]
    private Collection $inscriptions;

    /**
     * @var Collection<int, FichePresence>
     */
    #[ORM\OneToMany(targetEntity: FichePresence::class, mappedBy: 'session')]
    private Collection $fichePresences;

    /**
     * @var Collection<int, Monitoring>
     */
    #[ORM\OneToMany(targetEntity: Monitoring::class, mappedBy: 'session')]
    private Collection $monitorings;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->fichePresences = new ArrayCollection();
        $this->monitorings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTime
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTime $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTime $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getNombreMinParticipants(): ?int
    {
        return $this->nombreMinParticipants;
    }

    public function setNombreMinParticipants(int $nombreMinParticipants): static
    {
        $this->nombreMinParticipants = $nombreMinParticipants;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): static
    {
        $this->formation = $formation;

        return $this;
    }

    public function getFormateur(): ?Formateur
    {
        return $this->formateur;
    }

    public function setFormateur(?Formateur $formateur): static
    {
        $this->formateur = $formateur;

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
            $inscription->setSession($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getSession() === $this) {
                $inscription->setSession(null);
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
            $fichePresence->setSession($this);
        }

        return $this;
    }

    public function removeFichePresence(FichePresence $fichePresence): static
    {
        if ($this->fichePresences->removeElement($fichePresence)) {
            // set the owning side to null (unless already changed)
            if ($fichePresence->getSession() === $this) {
                $fichePresence->setSession(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Monitoring>
     */
    public function getMonitorings(): Collection
    {
        return $this->monitorings;
    }

    public function addMonitoring(Monitoring $monitoring): static
    {
        if (!$this->monitorings->contains($monitoring)) {
            $this->monitorings->add($monitoring);
            $monitoring->setSession($this);
        }

        return $this;
    }

    public function removeMonitoring(Monitoring $monitoring): static
    {
        if ($this->monitorings->removeElement($monitoring)) {
            // set the owning side to null (unless already changed)
            if ($monitoring->getSession() === $this) {
                $monitoring->setSession(null);
            }
        }

        return $this;
    }
}
