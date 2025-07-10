<?php

namespace App\DataFixtures;

use App\Entity\Responsable;
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
        // Admin
        $admin = new Responsable();
        $admin->setEmail('admin@example.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword(
            $this->passwordHasher->hashPassword($admin, 'adminpass123')
        );
        $manager->persist($admin);

        // Responsable Catalogue
        $catalogue = new Responsable();
        $catalogue->setEmail('catalogue@example.com');
        $catalogue->setRoles(['ROLE_RESPONSABLE_CATALOGUE']);
        $catalogue->setPassword(
            $this->passwordHasher->hashPassword($catalogue, 'cataloguepass')
        );
        $manager->persist($catalogue);

        // Responsable Logistique
        $logistique = new Responsable();
        $logistique->setEmail('logistique@example.com');
        $logistique->setRoles(['ROLE_RESPONSABLE_LOGISTIQUE']);
        $logistique->setPassword(
            $this->passwordHasher->hashPassword($logistique, 'logipass123')
        );
        $manager->persist($logistique);

        // Responsable Formation Inter
        $formationInter = new Responsable();
        $formationInter->setEmail('formation.inter@example.com');
        $formationInter->setRoles(['ROLE_RESPONSABLE_FORMATION_INTER']);
        $formationInter->setPassword(
            $this->passwordHasher->hashPassword($formationInter, 'formationpass')
        );
        $manager->persist($formationInter);

        $manager->flush();
    }
}
