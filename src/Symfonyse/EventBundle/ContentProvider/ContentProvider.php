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
class ContentProvider extends CoreContentProvider
{
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