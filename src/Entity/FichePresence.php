<?php

namespace App\Entity;

use App\Repository\FichePresenceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FichePresenceRepository::class)]
class FichePresence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $presence = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $commentaire = null;

    #[ORM\ManyToOne(inversedBy: 'fichePresences')]
    private ?Session $session = null;

    #[ORM\ManyToOne(inversedBy: 'fichePresences')]
    private ?Stagiaire $stagiaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isPresence(): ?bool
    {
        return $this->presence;
    }

    public function setPresence(bool $presence): static
    {
        $this->presence = $presence;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): static
    {
        $this->session = $session;

        return $this;
    }

    public function getStagiaire(): ?Stagiaire
    {
        return $this->stagiaire;
    }

    public function setStagiaire(?Stagiaire $stagiaire): static
    {
        $this->stagiaire = $stagiaire;

        return $this;
    }
}
