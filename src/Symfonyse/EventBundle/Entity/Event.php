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

    /**
     *
     *
     * @return \DateTime
     */
    public function getPostedAt()
    {
        $posted=$this->getMeta('timestamp');
        if (!$posted) {
            return parent::getPostedAt();
        }

        return new \DateTime($posted);
    }

    function getType()
    {
        return 'event';
    }
} 