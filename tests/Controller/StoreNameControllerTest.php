<?php

namespace App\Test\Controller;

use App\Entity\StoreName;
use App\Repository\StoreNameRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StoreNameControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private StoreNameRepository $repository;
    private string $path = '/store/name/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(StoreName::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('StoreName index');

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
            'store_name[name]' => 'Testing',
            'store_name[about]' => 'Testing',
            'store_name[description]' => 'Testing',
            'store_name[logo]' => 'Testing',
            'store_name[carsoule1]' => 'Testing',
            'store_name[carsoule2]' => 'Testing',
            'store_name[carsoule3]' => 'Testing',
            'store_name[updatedAt]' => 'Testing',
            'store_name[user]' => 'Testing',
        ]);

        self::assertResponseRedirects('/store/name/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new StoreName();
        $fixture->setName('My Title');
        $fixture->setAbout('My Title');
        $fixture->setDescription('My Title');
        $fixture->setLogo('My Title');
        $fixture->setCarsoule1('My Title');
        $fixture->setCarsoule2('My Title');
        $fixture->setCarsoule3('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setUser('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('StoreName');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new StoreName();
        $fixture->setName('My Title');
        $fixture->setAbout('My Title');
        $fixture->setDescription('My Title');
        $fixture->setLogo('My Title');
        $fixture->setCarsoule1('My Title');
        $fixture->setCarsoule2('My Title');
        $fixture->setCarsoule3('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setUser('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'store_name[name]' => 'Something New',
            'store_name[about]' => 'Something New',
            'store_name[description]' => 'Something New',
            'store_name[logo]' => 'Something New',
            'store_name[carsoule1]' => 'Something New',
            'store_name[carsoule2]' => 'Something New',
            'store_name[carsoule3]' => 'Something New',
            'store_name[updatedAt]' => 'Something New',
            'store_name[user]' => 'Something New',
        ]);

        self::assertResponseRedirects('/store/name/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getAbout());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getLogo());
        self::assertSame('Something New', $fixture[0]->getCarsoule1());
        self::assertSame('Something New', $fixture[0]->getCarsoule2());
        self::assertSame('Something New', $fixture[0]->getCarsoule3());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
        self::assertSame('Something New', $fixture[0]->getUser());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new StoreName();
        $fixture->setName('My Title');
        $fixture->setAbout('My Title');
        $fixture->setDescription('My Title');
        $fixture->setLogo('My Title');
        $fixture->setCarsoule1('My Title');
        $fixture->setCarsoule2('My Title');
        $fixture->setCarsoule3('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setUser('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/store/name/');
    }
}
