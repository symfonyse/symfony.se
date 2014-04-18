<?php

namespace Symfonyse\ContentBundle\Tests\Controller;

use Symfonyse\CoreBundle\Tests\BaseTestCase;

class PageControllerTest extends BaseTestCase
{
    public function testPageAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', $this->generateUrl('page', array('permalink'=>'styrelsen')));

        $this->assertTrue($crawler->filter('html:contains("Tobias Nyholm")')->count() > 0);
    }
}
