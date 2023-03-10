<?php

namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testlogin(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin/login');
        $crawler = $client->submitForm("Connexion", [
            "_username" => "admin@gmail.com",
            "_password" => "admin",
        ]);

        $this->assertResponseRedirects("http://localhost/admin");

    }
}
