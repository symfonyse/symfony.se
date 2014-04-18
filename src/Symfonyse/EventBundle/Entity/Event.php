<?php


namespace Symfonyse\EventBundle\Entity;

use Symfonyse\CoreBundle\Entity\FileBasedEntity;

/**
 * Class Event
 *
 * @author Tobias Nyholm
 *
 */
class Event extends FileBasedEntity
{
    function getType()
    {
        return 'event';
    }
} 