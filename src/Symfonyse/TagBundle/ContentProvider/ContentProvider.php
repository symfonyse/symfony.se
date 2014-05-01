<?php

namespace Symfonyse\TagBundle\ContentProvider;

use Symfonyse\CoreBundle\ContentProvider\CoreContentProvider;
use Symfonyse\TagBundle\Entity\Tag;

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
     * This is an array with content providers that provide entries that have a "tags" meta tag
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
     * @return Tag|null
     */
    public function getEntry($permalink)
    {
        if (null == $file = $this->getFile($permalink)) {
            return null;
        }

        return new Tag($file);
    }

    /**
     * Get all entries that is tagged with $tag
     *
     * @param Tag $tag
     *
     * @return array
     */
    public function getEntriesByTag(Tag $tag)
    {
        $tagEntries=array();
        foreach ($this->contentProviders as $cp) {
            $tagEntries = array_merge($tagEntries, array_filter($cp->getAllEntries(), function($e) use ($tag) {
                if (null == $tags = $e->getMeta('tags')) {
                    return false;
                }
                return in_array($tag->getTitle(), $tags);
            }));
        }


        return $tagEntries;
    }

    /**
     * Get all tags with the correct entry count
     *
     *
     * @return Tag[]
     */
    public function getAllEntries()
    {
        /*
         * Find out how often the tags are being used
         */
        $tags=array();
        foreach ($this->contentProviders as $cp) {
            $taggableEntries=$cp->getAllEntries();
            foreach ($taggableEntries as $entry) {
                if ($entry->getMeta('tags')===null) {
                    continue;
                }
                foreach ($entry->getMeta('tags') as $tag) {
                    if (empty($tags[$tag])) {
                        $tags[$tag]=0;
                    }
                    $tags[$tag]++;
                }
            }
        }

        $files = $this->getAllFiles();
        $entries=array();
        foreach ($files as $file) {
            $tag = new Tag($file);

            if (!empty($tags[$tag->getTitle()])) {
                $tag->setCount($tags[$tag->getTitle()]);
            }

            $entries[]=$tag;
        }

        return $entries;
    }

}