<?php

namespace Symfonyse\AuthorBundle\Entity;

use Symfonyse\CoreBundle\Entity\FileBasedEntity;

/**
 * Class Author.
 *
 * @author Tobias Nyholm
 */
class Author extends FileBasedEntity
{
    public function getType()
    {
        return 'author';
    }
}
