<?php

namespace Symfonyse\ContentBundle\Entity;

use Symfonyse\CoreBundle\Entity\FileBasedEntity;

/**
 * Class Page.
 *
 * @author Tobias Nyholm
 */
class Page extends FileBasedEntity
{
    public function getType()
    {
        return 'page';
    }
}
