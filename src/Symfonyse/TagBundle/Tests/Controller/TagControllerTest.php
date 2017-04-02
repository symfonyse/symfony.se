<?php

namespace Symfonyse\TagBundle\Tests\Controller;

use Symfonyse\CoreBundle\Tests\BaseTestCase;

class TagControllerTest extends BaseTestCase
{
    public function testEntryAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', $this->generateUrl('tag', array('permalink' => 'november-camp')));

        $this->assertTrue($crawler->filter('html:contains("November Camp")')->count() > 0);
    }
}
