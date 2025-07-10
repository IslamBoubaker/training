<?php

namespace App\Entity;

use App\Repository\ResponsableRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: ResponsableRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class Responsable implements UserInterface, PasswordAuthenticatedUserInterface
{
    public const ROLE_VISITEUR = 'ROLE_VISITEUR';
    public const ROLE_CLIENT = 'ROLE_CLIENT';
    public const ROLE_RESPONSABLE_CATALOGUE = 'ROLE_RESPONSABLE_CATALOGUE';
    public const ROLE_RESPONSABLE_LOGISTIQUE = 'ROLE_RESPONSABLE_LOGISTIQUE';
    public const ROLE_RESPONSABLE_FORMATION_INTER = 'ROLE_RESPONSABLE_FORMATION_INTER';
    public const ROLE_ADMIN = 'ROLE_ADMIN';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $roleResponsable = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        if (empty($roles)) {
            $roles[] = self::ROLE_VISITEUR;
        }
        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    #[\Deprecated]
    public function eraseCredentials(): void
    {
        // Ne rien faire, à retirer pour Symfony 8
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

    public function getRoleResponsable(): ?string
    {
        return $this->roleResponsable;
    }

    public function setRoleResponsable(string $roleResponsable): static
    {
        $this->roleResponsable = $roleResponsable;
        return $this;
    }
}
