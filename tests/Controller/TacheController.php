<?php

namespace App\Tests\Controller;

use App\Entity\Tache;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class TacheController extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $tacheRepository;
    private string $path = '/tache/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->tacheRepository = $this->manager->getRepository(Tache::class);

        foreach ($this->tacheRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    // public function testIndex(): void
    // {
    //     $this->client->followRedirects();
    //     $crawler = $this->client->request('GET', $this->path);

    //     self::assertResponseStatusCodeSame(200);
    //     self::assertPageTitleContains('Tache index');

    //     // Use the $crawler to perform additional assertions e.g.
    //     // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    // }

    // public function testNew(): void
    // {
    //     $this->markTestIncomplete();
    //     $this->client->request('GET', sprintf('%snew', $this->path));

    //     self::assertResponseStatusCodeSame(200);

    //     $this->client->submitForm('Save', [
    //         'tache[titre]' => 'Testing',
    //         'tache[statut]' => 'Testing',
    //         'tache[assignee]' => 'Testing',
    //     ]);

    //     self::assertResponseRedirects($this->path);

    //     self::assertSame(1, $this->tacheRepository->count([]));
    // }

    // public function testShow(): void
    // {
    //     $this->markTestIncomplete();
    //     $fixture = new Tache();
    //     $fixture->setTitre('My Title');
    //     $fixture->setStatut('My Title');
    //     $fixture->setAssignee('My Title');

    //     $this->manager->persist($fixture);
    //     $this->manager->flush();

    //     $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

    //     self::assertResponseStatusCodeSame(200);
    //     self::assertPageTitleContains('Tache');

    //     // Use assertions to check that the properties are properly displayed.
    // }

    // public function testEdit(): void
    // {
    //     $this->markTestIncomplete();
    //     $fixture = new Tache();
    //     $fixture->setTitre('Value');
    //     $fixture->setStatut('Value');
    //     $fixture->setAssignee('Value');

    //     $this->manager->persist($fixture);
    //     $this->manager->flush();

    //     $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

    //     $this->client->submitForm('Update', [
    //         'tache[titre]' => 'Something New',
    //         'tache[statut]' => 'Something New',
    //         'tache[assignee]' => 'Something New',
    //     ]);

    //     self::assertResponseRedirects('/tache/');

    //     $fixture = $this->tacheRepository->findAll();

    //     self::assertSame('Something New', $fixture[0]->getTitre());
    //     self::assertSame('Something New', $fixture[0]->getStatut());
    //     self::assertSame('Something New', $fixture[0]->getAssignee());
    // }

    // public function testRemove(): void
    // {
    //     $this->markTestIncomplete();
    //     $fixture = new Tache();
    //     $fixture->setTitre('Value');
    //     $fixture->setStatut('Value');
    //     $fixture->setAssignee('Value');

    //     $this->manager->persist($fixture);
    //     $this->manager->flush();

    //     $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
    //     $this->client->submitForm('Delete');

    //     self::assertResponseRedirects('/tache/');
    //     self::assertSame(0, $this->tacheRepository->count([]));
    // }
}
