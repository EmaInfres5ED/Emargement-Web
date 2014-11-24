<?php

namespace Ema\RgementBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReportControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'report/');

        $this->assertTrue($crawler->filter('html:contains("Rapports de cours")')->count() > 0);
    }

    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'report/show');

        $this->assertTrue($crawler->filter('html:contains("Rapports de cours")')->count() > 0);

        $crawler = $client->request('GET', 'report/show/1');

        $this->assertTrue($crawler->filter('html:contains("Rapport de cours")')->count() > 0);
    }

}
