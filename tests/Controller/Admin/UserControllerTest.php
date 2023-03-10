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
        //client automatically follow all redirects
        $client->followRedirects(true);
        // the request
        $crawler = $client->request('GET', '/admin/login');

        // SubmitForm with wrong datas
        $crawler = $client->submitForm("Connexion", [
            "_username" => "admin1@gmail.com",
            "_password" => "admin1",
        ]);

        // i check the path info between actuel path info and expected
        $this->assertEquals("/admin/login", $client->getRequest()->getPathInfo());

        // i check the page to ,see if we have a div with erro class
        $this->assertSelectorTextContains(".error", "Identifiants invalides.");
    }
}
