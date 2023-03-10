<?php

namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testloginok(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin/login');
        $crawler = $client->submitForm("Connexion", [
            "_username" => "admin@gmail.com",
            "_password" => "admin",
        ]);

        $this->assertResponseRedirects("http://localhost/admin");

    }

    public function testloginfalse(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin/login');
        $crawler = $client->submitForm("Connexion", [
            "_username" => "admin1@gmail.com",
            "_password" => "admin1",
        ]);

        $this->assertResponseRedirects("http://localhost/admin/login");

    }
}
