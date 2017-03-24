<?php

namespace Symfonyse\EventBundle\Entity;

use Symfonyse\CoreBundle\Entity\EntityInterface;

class MeetupEvent implements EntityInterface
{
    /**
     * @var array meta
     *
     */
    private $meta;

    public function __construct($meta)
    {
        $this->meta = $meta;
    }

    /**
     * @return mixed
     */
    public function getPermalink()
    {
        return $this->getMeta('id') . '/' . str_replace(' ', '-', $this->getTitle());
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->getMeta('name');
    }

    /**
     *
     *
     * @param $name
     *
     * @return mixed
     */
    public function getMeta($name)
    {
        if (!isset($this->meta[$name])) {
            return null;
        }

        return $this->meta[$name];
    }

    /**
     *
     *
     * @return \DateTime
     */
    public function getTime()
    {
        $date=new \DateTime();
        $date->setTimestamp($this->getMeta('time'));

        return $date;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->getMeta('description');
    }
}