<?php

namespace Symfonyse\TagBundle\Entity;

use Symfonyse\CoreBundle\Entity\FileBasedEntity;

/**
 * Class Tag.
 *
 * @author Tobias Nyholm
 */
class Tag extends FileBasedEntity
{
    /**
     * @var int count
     *
     * Number of times this tag has been used
     */
    protected $count;

    /**
     * @param int $count
     *
     * @return $this
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Get the type of the entity. This should be the same as the route.
     *
     * @return string
     */
    public function getType()
    {
        return 'tag';
    }
}
