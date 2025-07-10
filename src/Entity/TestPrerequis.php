<?php

namespace App\Entity;

use App\Repository\TestPrerequisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestPrerequisRepository::class)]
class TestPrerequis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private array $questions = [];

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Formation $formation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestions(): array
    {
        return $this->questions;
    }

    public function setQuestions(array $questions): static
    {
        $this->questions = $questions;

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
}
