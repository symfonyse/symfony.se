<?php

namespace Symfonyse\EventBundle\Entity;

use Symfonyse\CoreBundle\Entity\FileBasedEntity;

/**
 * Class Event.
 *
 * @author Tobias Nyholm
 */
class Event extends FileBasedEntity
{
    /**
     * @return \DateTime
     */
    public function getTime()
    {
        $timestamp = $this->getMeta('timestamp');
        if (!$timestamp) {
            return parent::getPostedAt();
        }

        return new \DateTime($timestamp);
    }

    public function getSortableTimestamp()
    {
        return $this->getTime()->getTimestamp();
    }

    public function getType()
    {
        return 'event';
    }
}
