<?php

namespace Symfonyse\CoreBundle\ContentProvider;

use Bloghoven\BlosxomDirProviderBundle\Entity\Entry;
use Bloghoven\BlosxomDirProviderBundle\Entity\Category;
use Symfonyse\CoreBundle\Model\FileInfo;

/**
 * Class CoreContentProvider
 *
 * @author Tobias Nyholm
 *
 *
 */
class CoreContentProvider
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
    public function getDataDir()
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
    protected function validatePermalink($permalink)
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
     * @return FileInfo|null
     */
    public function getFile($permalink)
    {
        $this->validatePermalink($permalink);
        $file= new FileInfo($this->dataDir.'/'.$permalink.'.'.$this->fileExtension, $permalink);

        if ($file->isFile()) {
            return $file;
        }

        return null;

    }
}