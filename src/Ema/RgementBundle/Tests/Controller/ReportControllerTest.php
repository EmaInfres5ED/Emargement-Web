<?php

namespace Ema\RgementBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReportControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'report/list');
    }

    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'report/show');
    }

}
