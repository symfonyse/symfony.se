<?php

namespace Symfonyse\EventBundle\Entity;

use Exception;
use Symfonyse\CoreBundle\Entity\EntityInterface;

class MeetupEvent implements EntityInterface
{
    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $title;
    /**
     * @var
     */
    private $timestamp;
    /**
     * @var
     */
    private $content;

    public function __construct($id, $title, $timestamp, $content)
    {
        $this->id        = $id;
        $this->title     = $title;
        $this->timestamp = $timestamp;
        $this->content   = $content;
    }

    /**
     * @return mixed
     */
    public function getPermalink()
    {
        return date('Y', $this->timestamp) . '/' . $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function getMeta($name)
    {
        switch ($name) {
            case 'timestamp':
                return date('Y-m-d H:i:s', $this->timestamp);
            default:
                throw new Exception('Unknown meta name: ' . $name);
        }
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }
}