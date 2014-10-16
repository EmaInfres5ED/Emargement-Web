<?php

namespace Ema\RgementBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testAdminPanelUserList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/user/list');

        $this->assertTrue($crawler->filter('html:contains("Utilisateurs")')->count() > 0);
    }

    public function testAdminPanelConfiuration()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/configuratuion');

        $this->assertTrue($crawler->filter('html:contains("Configuration")')->count() > 0);
    }

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertTrue($crawler->filter('html:contains("Tableau de bord")')->count() > 0);
    }

    public function testDashboard()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/dashboard');

        $this->assertTrue($crawler->filter('html:contains("Tableau de bord")')->count() > 0);
    }

}
