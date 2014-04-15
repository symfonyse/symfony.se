<?php

namespace Symfonyse\BlogBundle\Entity;

use Symfonyse\CoreBundle\Entity\FileBasedEntity;

/**
 *
 */
class Entry extends FileBasedEntity
{
    // These two are extra expensive to get, so whenever we get
    // one of them, we'll make sure to preload the other.
    protected $title;
    protected $contents;

    protected function getFileExtension()
    {
        return $this->fileInfo->getExtension();
    }

    public function getPermalink()
    {
        return $this->fileInfo->getPermalink();
    }

    public function getTitle()
    {
        if ($this->title === null) {
            $this->loadTitleAndContent();
        }

        return $this->title;
    }

    public function getExcerpt()
    {
        return $this->getContent();
    }

    public function getContent()
    {
        if ($this->content === null) {
            $this->loadTitleAndContent();
        }

        return $this->content;
    }

    protected function loadTitleAndContent()
    {
        $openedFile = $this->fileInfo->openFile();

        $this->title = trim($openedFile->current());
        $this->content = "";
        $openedFile->next();

        while (!$openedFile->eof()) {
            $this->content .= $openedFile->current();
            $openedFile->next();
        }
    }

    public function getPostedAt()
    {
        return \DateTime::createFromFormat('U', $this->fileInfo->getMTime());
    }

    public function getModifiedAt()
    {
        return \DateTime::createFromFormat('U', $this->fileInfo->getMTime());
    }

    public function getCategories()
    {

    }
}