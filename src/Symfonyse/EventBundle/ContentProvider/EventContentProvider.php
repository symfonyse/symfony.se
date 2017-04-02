<?php

namespace Symfonyse\EventBundle\ContentProvider;

use Symfonyse\EventBundle\Entity\Event;

interface EventContentProvider
{
    /**
     * Get the next event.
     *
     * @return Event|null
     */
    public function getNextEvent();

    /**
     * Get an array with upcoming events
     *
     * @return Event[]
     */

    public function getUpcomingEvents();

    /**
     * Get a event entry
     *
     * @param $permalink
     *
     * @return Event|null
     */
    public function getEntry($permalink);

    /**
     * Get all event entries
     */
    public function getAllEntries();
}