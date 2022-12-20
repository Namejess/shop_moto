<?php

namespace App\Test\Controller;

use App\Entity\Motos;
use App\Repository\MotosRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MotosControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private MotosRepository $repository;
    private string $path = '/motos/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Motos::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Moto index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'moto[Titre]' => 'Testing',
            'moto[Description]' => 'Testing',
            'moto[Kilometrage]' => 'Testing',
            'moto[Prix]' => 'Testing',
            'moto[DateImmat]' => 'Testing',
            'moto[Puissance]' => 'Testing',
        ]);

        self::assertResponseRedirects('/motos/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Motos();
        $fixture->setTitre('My Title');
        $fixture->setDescription('My Title');
        $fixture->setKilometrage('My Title');
        $fixture->setPrix('My Title');
        $fixture->setDateImmat('My Title');
        $fixture->setPuissance('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Moto');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Motos();
        $fixture->setTitre('My Title');
        $fixture->setDescription('My Title');
        $fixture->setKilometrage('My Title');
        $fixture->setPrix('My Title');
        $fixture->setDateImmat('My Title');
        $fixture->setPuissance('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'moto[Titre]' => 'Something New',
            'moto[Description]' => 'Something New',
            'moto[Kilometrage]' => 'Something New',
            'moto[Prix]' => 'Something New',
            'moto[DateImmat]' => 'Something New',
            'moto[Puissance]' => 'Something New',
        ]);

        self::assertResponseRedirects('/motos/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitre());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getKilometrage());
        self::assertSame('Something New', $fixture[0]->getPrix());
        self::assertSame('Something New', $fixture[0]->getDateImmat());
        self::assertSame('Something New', $fixture[0]->getPuissance());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Motos();
        $fixture->setTitre('My Title');
        $fixture->setDescription('My Title');
        $fixture->setKilometrage('My Title');
        $fixture->setPrix('My Title');
        $fixture->setDateImmat('My Title');
        $fixture->setPuissance('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/motos/');
    }
}
