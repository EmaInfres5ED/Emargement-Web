<?php

namespace Ema\RgementBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testAjaxsynchronizestudentsandpromos()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ajaxSynchronizeStudentsAndPromos');
    }

}
