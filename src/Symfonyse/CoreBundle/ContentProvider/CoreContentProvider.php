<?php

namespace Symfonyse\CoreBundle\ContentProvider;

use Bloghoven\BlosxomDirProviderBundle\Entity\Entry;
use Bloghoven\BlosxomDirProviderBundle\Entity\Category;

/**
 * Class CoreContentProvider
 *
 * @author Tobias Nyholm
 *
 *
 */
abstract class CoreContentProvider
{
    protected $dataDir;
    protected $fileExtension;
    protected $depth;

    /**
     * @param string $dataDir
     * @param string $fileExtension
     * @param int $depth
     */
    public function __construct($dataDir, $fileExtension = 'txt', $depth = 0)
    {
        $this->dataDir = $dataDir;
        $this->fileExtension = $fileExtension;
        $this->depth = (int)$depth;
    }

    /**
     * Get the data dir
     *
     * @return string
     */
    protected function getDataDir()
    {
        return $this->dataDir;
    }

    /**
     * Make sure that this is a valid permalink
     *
     * @param string $permalink
     *
     * @throws \RuntimeException
     */
    protected function validatePermalinkId($permalink)
    {
        if (strpos($permalink, '..') !== false) {
            throw new \RuntimeException("Permalinks with double dots are not allowed with the current provider, and are always advised against.");
        }
    }

    /**
     * Get the file. This will also validate the permalink.
     *
     * @param $permalink
     *
     * @return \SplFileInfo
     */
    protected function getFile($permalink)
    {
        $this->validatePermalinkId($permalink);

        return new \SplFileInfo($this->datadir.'/'.$permalink.'.'.$this->file_extension);
    }
}