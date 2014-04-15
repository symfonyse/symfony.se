<?php

namespace Symfonyse\BlogBundle\Entity;

use Symfonyse\CoreBundle\Entity\FileBasedEntity;

/**
 *
 */
class Tag extends FileBasedEntity
{
    public function getName()
    {
        return $this->fileInfo->getBasename();
    }

    public function getPermalink()
    {
        return $this->getRelativePathname();
    }

}
