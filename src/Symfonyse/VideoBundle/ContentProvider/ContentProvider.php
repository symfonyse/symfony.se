<?php

namespace Symfonyse\VideoBundle\ContentProvider;

use Symfonyse\CoreBundle\ContentProvider\CoreContentProvider;
use Symfonyse\VideoBundle\Entity\Video;

/**
 * Class ContentProvider.
 *
 * @author Tobias Nyholm
 */
class ContentProvider extends CoreContentProvider
{
    /**
     * Get a video entry.
     *
     * @param $permalink
     *
     * @return Video|null
     */
    public function getEntry($permalink)
    {
        if (null == $file = $this->getFile($permalink)) {
            return null;
        }

        return new Video($file);
    }

    /**
     * Get all video entries.
     */
    public function getAllEntries()
    {
        $files = $this->getAllFiles();

        $videos = array();
        foreach ($files as $file) {
            $videos[] = new Video($file);
        }

        return $videos;
    }
}
