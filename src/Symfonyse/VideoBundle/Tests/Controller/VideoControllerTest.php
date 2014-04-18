<?php

namespace Symfonyse\VideoBundle\Tests\Controller;

use Symfonyse\CoreBundle\Tests\BaseTestCase;

class VideoControllerTest extends BaseTestCase
{
    public function testIndexAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', $this->generateUrl('video_index'));

        $this->assertTrue($crawler->filter('html:contains("Detta är våra videor")')->count() > 0);
    }

    public function testEntryAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', $this->generateUrl('video', array('permalink'=>'intro')));

        $this->assertTrue($crawler->filter('html:contains("exempel video")')->count() > 0);
    }
}
