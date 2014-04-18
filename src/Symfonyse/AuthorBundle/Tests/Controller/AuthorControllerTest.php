<?php

namespace Symfonyse\AuthorBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfonyse\CoreBundle\Tests\BaseTestCase;

class AuthorControllerTest extends BaseTestCase
{
    public function testEntryAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $this->generateUrl('author', array('permalink'=>'tobiasnyholm')));

        $this->assertTrue($crawler->filter('html:contains("Tobias Nyholm")')->count() > 0);
    }
}
