<?php

namespace Symfonyse\ContentBundle\ContentProvider;

use Symfonyse\ContentBundle\Entity\Page;
use Symfonyse\CoreBundle\ContentProvider\CoreContentProvider;

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
     * Get all page entries
     */
    public function getAllEntries()
    {
        $files = $this->getAllFiles();

        $entries=array();
        foreach ($files as $file) {
            $entries[] = new Page($file);
        }

        return $entries;
    }
}