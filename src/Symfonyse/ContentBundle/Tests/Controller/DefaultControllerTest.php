<?php

namespace Symfonyse\ContentBundle\Tests\Controller;

use Symfonyse\CoreBundle\Tests\BaseTestCase;

class DefaultControllerTest extends BaseTestCase
{
    public function testHomepageAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', $this->generateUrl('homepage'));

        $this->assertTrue($crawler->filter('html:contains("Startsida")')->count() > 0);
    }
}
