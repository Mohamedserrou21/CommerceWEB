<?php

namespace App\Test\Controller;

use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProduitsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ProduitsRepository $repository;
    private string $path = '/produits/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Produits::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Produit index');

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
            'produit[nom]' => 'Testing',
            'produit[description]' => 'Testing',
            'produit[prix]' => 'Testing',
            'produit[image]' => 'Testing',
            'produit[updatedAt]' => 'Testing',
            'produit[store]' => 'Testing',
        ]);

        self::assertResponseRedirects('/produits/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Produits();
        $fixture->setNom('My Title');
        $fixture->setDescription('My Title');
        $fixture->setPrix('My Title');
        $fixture->setImage('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setStore('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Produit');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Produits();
        $fixture->setNom('My Title');
        $fixture->setDescription('My Title');
        $fixture->setPrix('My Title');
        $fixture->setImage('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setStore('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'produit[nom]' => 'Something New',
            'produit[description]' => 'Something New',
            'produit[prix]' => 'Something New',
            'produit[image]' => 'Something New',
            'produit[updatedAt]' => 'Something New',
            'produit[store]' => 'Something New',
        ]);

        self::assertResponseRedirects('/produits/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getPrix());
        self::assertSame('Something New', $fixture[0]->getImage());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
        self::assertSame('Something New', $fixture[0]->getStore());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Produits();
        $fixture->setNom('My Title');
        $fixture->setDescription('My Title');
        $fixture->setPrix('My Title');
        $fixture->setImage('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setStore('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/produits/');
    }
}
