<?php

namespace Symfonyse\EventBundle\Tests\Controller;

use Symfonyse\CoreBundle\Tests\BaseTestCase;

class EventControllerTest extends BaseTestCase
{
    public function testIndexAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', $this->generateUrl('event_index'));

        $this->assertTrue($crawler->filter('html:contains("Planerade events")')->count() > 0);
    }

    public function testEntryAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', $this->generateUrl('event', array('permalink' => '2014/phparlor-neo4j')));

        $this->assertTrue($crawler->filter('html:contains("Jacob Hansson")')->count() > 0);
    }
}
