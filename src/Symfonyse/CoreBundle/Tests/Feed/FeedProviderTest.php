<?php

namespace Symfonyse\CoreBundle\Tests\Feed;

use Debril\RssAtomBundle\Protocol\Parser\FeedContent;
use dflydev\markdown\MarkdownParser;
use HappyR\ExcerptBundle\Service\PhpExcerpt;
use Symfony\Component\OptionsResolver\Options;
use Symfonyse\CoreBundle\Feed\FeedProvider;

class FeedProviderTest extends \PHPUnit_FrameWork_TestCase
{
    public function testProvider()
    {
        $router = $this->getRouter();
        $markdownParser = new MarkdownParser();
        $contentProvider = $this->getContentProvider();
        $excerpt = new PhpExcerpt();
        $provider = new FeedProvider($contentProvider, $markdownParser, $router, $excerpt);
        $options = new Options();

        $response = $provider->getFeedContent($options);

        $this->assertTrue($response instanceof FeedContent, 'FeedProvider should return a FeedContent response');
    }

    protected function getContentProvider()
    {
        $mock = $this->getMockBuilder('Symfonyse\BlogBundle\ContentProvider\ContentProvider')
            ->disableOriginalConstructor()
            ->setMethods(['getAllEntries'])
            ->getMock();

        $mock->expects($this->once())->method('getAllEntries')->will($this->returnValue([]));

        return $mock;
    }

    protected function getRouter()
    {
        return $this->getMockBuilder('Symfony\Bundle\FrameworkBundle\Routing\Router')
            ->disableOriginalConstructor()
            ->setMethods(['generate'])
            ->getMock();
    }
}
