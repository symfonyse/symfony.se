<?php

namespace Symfonyse\AuthorBundle\ContentProvider;

use Symfonyse\AuthorBundle\Entity\Author;
use Symfonyse\CoreBundle\ContentProvider\CoreContentProvider;

/**
 * Class ContentProvider
 *
 * @author Tobias Nyholm
 *
 *
 */
class ContentProvider extends CoreContentProvider
{
    /**
     * @var CoreContentProvider[] contentProviders
     *
     * This is an array with content providers that provide entries that have a "authors" meta tag
     *
     */
    private $contentProviders;

    /**
     *
     * @param \Symfonyse\CoreBundle\ContentProvider\CoreContentProvider[] $cps
     *
     * @return $this
     */
    public function setContentProviders($cps)
    {
        $this->contentProviders = $cps;

        return $this;
    }

    /**
     * Get a Author entry
     *
     * @param $permalink
     *
     * @return Author|null
     */
    public function getEntry($permalink)
    {
        if (null == $file = $this->getFile($permalink)) {
            return null;
        }

        return new Author($file);
    }

    /**
     * Get all entries by this author
     *
     * @param Author $author
     *
     * @return array
     */
    public function getEntriesByAuthor(Author $author)
    {
        $authorEntries=array();
        foreach ($this->contentProviders as $cp) {
            $authorEntries = array_merge($authorEntries, array_filter($cp->getAllEntries(), function($e) use ($author) {
                if (null == $authors = $e->getMeta('authors')) {
                    return false;
                }
                return in_array($author->getTitle(), $authors);
            }));
        }


        return $authorEntries;
    }

    /**
     * Get all entries of the object.
     *
     * @return array
     */
    public function getAllEntries()
    {
        //TODO implement me
        return array();
    }
}