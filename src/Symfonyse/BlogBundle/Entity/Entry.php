<?php

namespace Symfonyse\BlogBundle\Entity;

use Symfonyse\CoreBundle\Entity\FileBasedEntity;

/**
 * Class Entry
 *
 * @author Tobias Nyholm
 *
 *
 */
class Entry extends FileBasedEntity
{
    const EXCERPT_LENGTH=250;

    protected function getFileExtension()
    {
        return $this->fileInfo->getExtension();
    }

    /**
     * Get the permalink
     *
     * @return string
     */
    public function getPermalink()
    {
        return $this->fileInfo->getPermalink();
    }

    /**
     * Get the title
     *
     * @return mixed|null
     */
    public function getTitle()
    {
        return $this->getMeta('title');
    }

    /**
     * Get the excerpt
     *
     * @return string
     */
    public function getExcerpt()
    {
        return mb_substr($this->getContent(), 0, self::EXCERPT_LENGTH);
    }
}