<?php

namespace App\Tests\Controller;

use App\Entity\Formateur;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class FormateurControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $formateurRepository;
    private string $path = '/formateur/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->formateurRepository = $this->manager->getRepository(Formateur::class);

        foreach ($this->formateurRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Formateur index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'formateur[nom]' => 'Testing',
            'formateur[prenom]' => 'Testing',
            'formateur[email]' => 'Testing',
            'formateur[cv]' => 'Testing',
            'formateur[note]' => 'Testing',
            'formateur[estValide]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->formateurRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Formateur();
        $fixture->setNom('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setEmail('My Title');
        $fixture->setCv('My Title');
        $fixture->setNote('My Title');
        $fixture->setEstValide('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Formateur');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Formateur();
        $fixture->setNom('Value');
        $fixture->setPrenom('Value');
        $fixture->setEmail('Value');
        $fixture->setCv('Value');
        $fixture->setNote('Value');
        $fixture->setEstValide('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'formateur[nom]' => 'Something New',
            'formateur[prenom]' => 'Something New',
            'formateur[email]' => 'Something New',
            'formateur[cv]' => 'Something New',
            'formateur[note]' => 'Something New',
            'formateur[estValide]' => 'Something New',
        ]);

        self::assertResponseRedirects('/formateur/');

        $fixture = $this->formateurRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getPrenom());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getCv());
        self::assertSame('Something New', $fixture[0]->getNote());
        self::assertSame('Something New', $fixture[0]->getEstValide());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Formateur();
        $fixture->setNom('Value');
        $fixture->setPrenom('Value');
        $fixture->setEmail('Value');
        $fixture->setCv('Value');
        $fixture->setNote('Value');
        $fixture->setEstValide('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/formateur/');
        self::assertSame(0, $this->formateurRepository->count([]));
    }
}
