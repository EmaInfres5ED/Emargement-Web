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

}
