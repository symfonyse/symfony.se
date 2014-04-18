<?php

namespace Symfonyse\TagBundle\Entity;

use Symfonyse\CoreBundle\Entity\FileBasedEntity;

/**
 * Class Tag
 *
 * @author Tobias Nyholm
 *
 *
 */
class Tag extends FileBasedEntity
{
    function getType()
    {
        return 'tag';
    }
}
