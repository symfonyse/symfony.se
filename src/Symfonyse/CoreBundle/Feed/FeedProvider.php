<?php

namespace Symfonyse\CoreBundle\Feed;

use Debril\RssAtomBundle\Protocol\Parser\FeedContent;
use Debril\RssAtomBundle\Provider\FeedContentProvider;
use dflydev\markdown\MarkdownParser;
use HappyR\ExcerptBundle\Service\ExcerptInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RouterInterface;
use Symfonyse\BlogBundle\ContentProvider\ContentProvider as BlogContentProvider;

class FeedProvider implements FeedContentProvider
{
    /**
     * @var BlogContentProvider
     */
    private $blogContentProvider;
    /**
     * @var \dflydev\markdown\MarkdownParser
     */
    private $markdownParser;
    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;
    /**
     * @var \HappyR\ExcerptBundle\Service\ExcerptInterface
     */
    private $excerpt;

    public function __construct(
        BlogContentProvider $blogContentProvider,
        MarkdownParser $markdownParser,
        RouterInterface $router,
        ExcerptInterface $excerpt
    ) {
        $this->blogContentProvider = $blogContentProvider;
        $this->markdownParser = $markdownParser;
        $this->router = $router;
        $this->excerpt = $excerpt;
    }

    /**
     * @param Options $options
     *
     * @throws \Debril\RssAtomBundle\Exception\FeedNotFoundException
     *
     * @return FeedContent
     */
    public function getFeedContent(Options $options)
    {
        $feed = new FeedContent();
        $feed->setTitle('Symfony Sverige');

        $maxModified = null;

        foreach ($this->blogContentProvider->getAllEntries() as $entry) {
            $markdown = $this->markdownParser->transformMarkdown($entry->getContent());
            $url = $this->router->generate('blog', ['permalink' => $entry->getPermalink()], Router::ABSOLUTE_URL);

            $item = new FeedItem();
            $item->setUpdated($entry->getModifiedAt());
            $item->setTitle($entry->getTitle());
            $item->setDescription($this->excerpt->getExcerpt($markdown));
            $item->setLink($url);

            $feed->addItem($item);

            if (!$maxModified || $entry->getModifiedAt() > $maxModified) {
                $maxModified = $entry->getModifiedAt();
            }
        }

        if ($maxModified) {
            $feed->setLastModified($maxModified);
        }

        return $feed;
    }
}
