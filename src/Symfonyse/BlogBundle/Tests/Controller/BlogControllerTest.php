<?php

namespace Symfonyse\AuthorBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfonyse\CoreBundle\Tests\BaseTestCase;

class BlogControllerTest extends BaseTestCase
{
    public function testEntryAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $this->generateUrl('blog', array('permalink'=>'2014/planering-infor-november-camp')));

        $this->assertTrue($crawler->filter('html:contains("November Camp")')->count() > 0);
    }
}
