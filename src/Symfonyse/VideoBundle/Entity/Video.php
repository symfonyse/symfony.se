<?php


namespace Symfonyse\VideoBundle\Entity;

use Symfonyse\CoreBundle\Entity\FileBasedEntity;

/**
 * Class Video
 *
 * @author Tobias Nyholm
 *
 */
class Video extends FileBasedEntity
{
    /**
     *
     *
     * @return \DateTime
     */
    public function getRecordedAt()
    {
        $posted=$this->getMeta('timestamp');
        if (!$posted) {
            return parent::getPostedAt();
        }

        return new \DateTime($posted);
    }

    function getType()
    {
        return 'video';
    }
} 