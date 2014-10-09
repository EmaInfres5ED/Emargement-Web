<?php

namespace Ema\RgementBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testAdminPanelUserList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/adminPanel/userList');

        $this->assertTrue($crawler->filter('html:contains("Liste d\'utilisateur")')->count() > 0);
    }
}
