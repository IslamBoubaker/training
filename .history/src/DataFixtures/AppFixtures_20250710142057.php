<?php

namespace App\DataFixtures;

use App\Entity\Responsable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $usersData = [
            [
                'nom' => 'Admin',
                'prenom' => 'Général',
                'email' => 'admin@example.com',
                'role_responsable' => 'admin',
                'roles' => ['ROLE_ADMIN'],
                'password' => 'adminpass123',
            ],
            [
                'nom' => 'Responsable',
                'prenom' => 'Catalogue',
                'email' => 'catalogue@example.com',
                'role_responsable' => 'catalogue',
                'roles' => ['ROLE_RESPONSABLE_CATALOGUE'],
                'password' => 'cataloguepass',
            ],
            [
                'nom' => 'Responsable',
                'prenom' => 'Logistique',
                'email' => 'logistique@example.com',
                'role_responsable' => 'logistique',
                'roles' => ['ROLE_RESPONSABLE_LOGISTIQUE'],
                'password' => 'logipass123',
            ],
            [
                'nom' => 'Responsable',
                'prenom' => 'Formation Inter',
                'email' => 'formation.inter@example.com',
                'role_responsable' => 'formation_inter',
                'roles' => ['ROLE_RESPONSABLE_FORMATION_INTER'],
                'password' => 'formationpass',
            ],
        ];

        foreach ($usersData as $data) {
            $user = new Responsable();
            $user->setNom($data['nom']);
            $user->setPrenom($data['prenom']);
            $user->setEmail($data['email']);
            $user->setRoleResponsable($data['role_responsable']);
            $user->setRoles($data['roles']);
            $user->setPassword(
                $this->passwordHasher->hashPassword($user, $data['password'])
            );
            $manager->persist($user);
        }

        $manager->flush();
    }
}
