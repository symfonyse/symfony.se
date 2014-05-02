<?php

namespace Symfonyse\EventBundle\ContentProvider;

use Symfonyse\CoreBundle\ContentProvider\CoreContentProvider;
use Symfonyse\EventBundle\Entity\Event;

/**
 * Class ContentProvider
 *
 * @author Tobias Nyholm
 *
 *
 */
class FileContentProvider extends CoreContentProvider implements EventContentProvider
{
    /**
     * Get the next event.
     *
     * @return null|Event
     */
    public function getNextEvent()
    {
        $events = $this->getAllEntries();
        $this->sortEntries($events);

        $prevEvent=null;
        $now = new \DateTime();
        foreach ($events as $event) {
            /* @var $event \Symfonyse\EventBundle\Entity\Event */
            if ($event->getPostedAt() < $now) {
                return $prevEvent;
            }

            $prevEvent = $event;
        }

        return null;
    }

    /**
     * Get an array with upcoming events
     *
     *
     * @return array
     */
    public function getUpcomingEvents()
    {
        $events = $this->getAllEntries();
        $this->sortEntries($events);

        $upcoming=array();
        $now = new \DateTime();
        foreach ($events as $event) {
            /* @var $event \Symfonyse\EventBundle\Entity\Event */
            if ($event->getPostedAt() > $now) {
                $upcoming[]= $event;
            }
        }

        /*
         * Assert: This array will be sorted so the next event is the first element
         * and the last element is the planned event that will be in the far future
         */
        return $upcoming;
    }



    /**
     * Get a event entry
     *
     * @param $permalink
     *
     * @return Event|null
     */
    public function getEntry($permalink)
    {
        if (null == $file = $this->getFile($permalink)) {
            return null;
        }

        return new Event($file);
    }

    /**
     * Get all event entries
     */
    public function getAllEntries()
    {
        $files = $this->getAllFiles();

        $events=array();
        foreach ($files as $file) {
            $events[] = new Event($file);
        }

        return $events;
    }
}