<?php

namespace Symfonyse\AuthorBundle\Tests\Controller;

use Symfonyse\CoreBundle\Tests\BaseTestCase;

class AuthorControllerTest extends BaseTestCase
{
    public function testEntryAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $this->generateUrl('author', array('permalink' => 'tobias-nyholm')));

        $this->assertTrue($crawler->filter('html:contains("Tobias Nyholm")')->count() > 0);
    }
}
