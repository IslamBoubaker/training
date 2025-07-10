<?php

// src/DataFixtures/UserFixtures.php (ou AppFixtures.php)
namespace App\DataFixtures;

use App\Entity\User; // Assurez-vous d'utiliser la bonne entité (User ou Responsable)
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface; // N'oubliez pas le use !

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Création d'un utilisateur de test (par exemple, un administrateur)
        $userAdmin = new User(); // Ou new Responsable() si c'est votre entité de connexion
        $userAdmin->setEmail('admin@example.com'); // L'email que vous utiliserez pour vous connecter
        $userAdmin->setRoles(['ROLE_ADMIN']); // Attribuez un rôle approprié
        $userAdmin->setPassword(
            $this->passwordHasher->hashPassword(
                $userAdmin,
                'password' // Le mot de passe en clair que vous utiliserez pour vous connecter
            )
        );
        $manager->persist($userAdmin);

        // Vous pouvez ajouter d'autres utilisateurs si nécessaire
        // $userClient = new User();
        // $userClient->setEmail('client@example.com');
        // $userClient->setRoles(['ROLE_CLIENT']);
        // $userClient->setPassword($this->passwordHasher->hashPassword($userClient, 'clientpass'));
        // $manager->persist($userClient);

        $manager->flush(); // Enregistre les utilisateurs dans la base de données
    }
}