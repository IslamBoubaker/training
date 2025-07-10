<?php

namespace App\DataFixtures;

use App\Entity\User; // Ou App\Entity\Responsable selon ce que tu utilises
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User(); // Ou new Responsable() si tu utilises cette classe

        $user->setUsername('admin'); // 🔴 Important si ton entité a un champ `username`
        $user->setEmail('admin@example.com');
        $user->setRoles(['ROLE_ADMIN']);

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'password' // mot de passe en clair
        );
        $user->setPassword($hashedPassword);

        $manager->persist($user);
        $manager->flush();
    }
}
