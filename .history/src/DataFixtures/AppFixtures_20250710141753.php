<?php

namespace App\DataFixtures;

use App\Entity\User; // ou App\Entity\Responsable si tu veux le faire avec cette classe
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
        // ADMIN
        $admin = new User();
        // $admin->setUsername('admin');
        $admin->setEmail('admin@example.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'adminpass'));
        $manager->persist($admin);

        // VISITEUR
        $visiteur = new User();
        // $visiteur->setUsername('visiteur');
        $visiteur->setEmail('visiteur@example.com');
        $visiteur->setRoles(['ROLE_VISITEUR']);
        $visiteur->setPassword($this->passwordHasher->hashPassword($visiteur, 'visiteurpass'));
        $manager->persist($visiteur);

        // CLIENT
        $client = new User();
        // $client->setUsername('client');
        $client->setEmail('client@example.com');
        $client->setRoles(['ROLE_CLIENT']);
        $client->setPassword($this->passwordHasher->hashPassword($client, 'clientpass'));
        $manager->persist($client);

        // RESPONSABLE CATALOGUE
        $catalogue = new User();
        // $catalogue->setUsername('catalogue');
        $catalogue->setEmail('catalogue@example.com');
        $catalogue->setRoles(['ROLE_RESPONSABLE_CATALOGUE']);
        $catalogue->setPassword($this->passwordHasher->hashPassword($catalogue, 'cataloguepass'));
        $manager->persist($catalogue);

        // RESPONSABLE LOGISTIQUE
        $logistique = new User();
        // $logistique->setUsername('logistique');
        $logistique->setEmail('logistique@example.com');
        $logistique->setRoles(['ROLE_RESPONSABLE_LOGISTIQUE']);
        $logistique->setPassword($this->passwordHasher->hashPassword($logistique, 'logistiquepass'));
        $manager->persist($logistique);

        // RESPONSABLE FORMATION INTER
        $formationInter = new User();
        // $formationInter->setUsername('formationinter');
        $formationInter->setEmail('formationinter@example.com');
        $formationInter->setRoles(['ROLE_RESPONSABLE_FORMATION_INTER']);
        $formationInter->setPassword($this->passwordHasher->hashPassword($formationInter, 'interpass'));
        $manager->persist($formationInter);

        // FORMATEUR
        $formateur = new User();
        // $formateur->setUsername('formateur');
        $formateur->setEmail('formateur@example.com');
        $formateur->setRoles(['ROLE_FORMATEUR']);
        $formateur->setPassword($this->passwordHasher->hashPassword($formateur, 'formateurpass'));
        $manager->persist($formateur);

        // STAGIAIRE
        $stagiaire = new User();
        // $stagiaire->setUsername('stagiaire');
        $stagiaire->setEmail('stagiaire@example.com');
        $stagiaire->setRoles(['ROLE_STAGIAIRE']);
        $stagiaire->setPassword($this->passwordHasher->hashPassword($stagiaire, 'stagiairepass'));
        $manager->persist($stagiaire);

        $manager->flush();
    }
}
