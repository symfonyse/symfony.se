<?php

namespace Symfonyse\BlogBundle\Entity;

use Symfonyse\CoreBundle\Entity\FileBasedEntity;

/**
 * Class Entry.
 *
 * @author Tobias Nyholm
 */
class Entry extends FileBasedEntity
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'blog';
    }
}
