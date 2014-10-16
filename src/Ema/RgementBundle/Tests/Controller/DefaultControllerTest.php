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

    public function testStatsAccumulationAbsence()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/stats/accumulation/absence');

        $this->assertTrue($crawler->filter('html:contains("Cumul des absences")')->count() > 0);
    }

    public function testStatsAccumulationDelay()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/stats/accumulation/delay');

        $this->assertTrue($crawler->filter('html:contains("Cumul des retards")')->count() > 0);
    }

    public function testStatsFrequencyAbsence()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/stats/frequency/absence');

        $this->assertTrue($crawler->filter('html:contains("Fréquence des absences")')->count() > 0);
    }

    public function testStatsFrequencyDelay()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/stats/frequency/delay');

        $this->assertTrue($crawler->filter('html:contains("Fréquence des retards")')->count() > 0);
    }

    public function testStats()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/stats/');

        $this->assertTrue($crawler->filter('html:contains("Statistiques des retards et absences")')->count() > 0);
    }

    public function testWarnAbsence()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/warn/absence');

        $this->assertTrue($crawler->filter('html:contains("Prévenir d\'une absence")')->count() > 0);
    }

    public function testWarnDelay()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/warn/delay');

        $this->assertTrue($crawler->filter('html:contains("Prévenir d\'un retard")')->count() > 0);
    }

}
