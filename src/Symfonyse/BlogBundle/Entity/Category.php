<?php

namespace Symfonyse\BlogBundle\Entity;

use Symfony\Component\Finder\Finder;
use Symfonyse\CoreBundle\Entity\FileBasedEntity;

/**
 *
 */
class Category extends FileBasedEntity
{
    public function getName()
    {
        return $this->fileInfo->getBasename();
    }

    public function getPermalinkId()
    {
        return $this->getRelativePathname();
    }

    public function getParent()
    {
        return parent::getParent();
    }

    public function getChildren()
    {
        $finder = new Finder();

        $finder
            ->directories()
            ->in($this->fileInfo->getPathname())
            ->depth('== 0')
            ->sortByName();

        $categories = array();

        foreach ($finder as $dir) {
            $categories[] = new Category($dir, $this->contentProvider);
        }

        return $categories;
    }
}
