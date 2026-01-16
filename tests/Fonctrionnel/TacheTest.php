<?php

namespace App\Tests\Fonctrionnel;

use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class TacheTest extends WebTestCase
{
    public function testAccessDeniedIndexGuest()
    {
        $client = static::createClient();
        $client->request("GET", "/tache");
        $this->assertResponseRedirects("/login");
    }
    public function testAccessDeniedNewGuest()
    {
        $client = static::createClient();
        $client->request("GET", "/tache/new");
        $this->assertResponseRedirects("/login");
    }
    public function testLoggedUserCreateNewTask()
    {
        // $client = static::createClient();
        // $crawler = $client->request("GET", "/register");
        // $email = 'testuser' . uniqid('', true) . "@test.local";
        // $form = $crawler->selectButton('Register')->form([
        //     'registration_form[email]' => $email,
        //     'registration_form[plainPassword]' => 'pass1234',
        //     'registration_form[agreeTerms]' => 1
        // ]);
        // $client->submit($form);
        // $this->assertResponseRedirects();
        // $client->followRedirect();
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UtilisateurRepository::class);
        $testUser = $userRepository->findOneByEmail('testuser@test.local');
        $client->loginUser($testUser);
        $crawlerTache = $client->request("GET", "/tache/new");
        $formTache = $crawlerTache->selectButton('Save')->form([
            'tache[titre]' => 'Testing',
            'tache[statut]' => 'Testing'
        ]);
        $client->submit($formTache);
        $this->assertResponseRedirects('/tache');
    }
}
