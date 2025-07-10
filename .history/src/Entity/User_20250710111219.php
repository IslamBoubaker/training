<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity]
#[ORM\Table(name: '`user`')]
class User implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id = null;

    #[ORM\Column(type:"string", length:180, unique:true)]
    #[Assert\NotBlank(message: "Le nom d'utilisateur ne peut pas être vide.")]
    private ?string $username = null;

    #[ORM\Column(type:"string", length:180, unique:true)]
    #[Assert\NotBlank(message: "L'email ne peut pas être vide.")]
    #[Assert\Email(message: "L'adresse email '{{ value }}' n'est pas valide.")]
    private ?string $email = null;

    #[ORM\Column(type:"json")]
    private array $roles = [];

    #[ORM\Column(type:"string")]
    #[Assert\NotBlank(message: "Le mot de passe ne peut pas être vide.")]
    private ?string $password = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // Toujours garantir ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getSalt(): ?string
    {
        // Non nécessaire avec bcrypt ou sodium
        return null;
    }

    public function eraseCredentials(): void
    {
        // Si tu stockes temporairement des infos sensibles, efface-les ici
    }
}
