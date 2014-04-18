<?php


namespace Symfonyse\AuthorBundle\Entity;

use Symfonyse\CoreBundle\Entity\FileBasedEntity;

/**
 * Class Author
 *
 * @author Tobias Nyholm
 *
 */
class Author extends FileBasedEntity
{
    function getType()
    {
        return 'author';
    }
}