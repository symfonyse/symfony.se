<?php

namespace Symfonyse\BlogBundle\ContentProvider;

use Symfonyse\BlogBundle\Entity\Entry;
use Symfonyse\CoreBundle\ContentProvider\CoreContentProvider;

/**
 * Class ContentProvider.
 *
 * @author Tobias Nyholm
 */
class ContentProvider extends CoreContentProvider
{
    /**
     * Get a event entry.
     *
     * @param $permalink
     *
     * @return Entry|null
     */
    public function getEntry($permalink)
    {
        if (null == $file = $this->getFile($permalink)) {
            return null;
        }

        return new Entry($file);
    }

    /**
     * Get all event entries.
     *
     * @return Entry[]
     */
    public function getAllEntries()
    {
        $files = $this->getAllFiles();

        $entries = array();
        foreach ($files as $file) {
            $entries[] = new Entry($file);
        }

        return $entries;
    }
}
