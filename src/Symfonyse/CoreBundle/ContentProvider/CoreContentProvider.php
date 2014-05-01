<?php

namespace Symfonyse\CoreBundle\ContentProvider;

use Symfony\Component\Finder\Finder;
use Symfonyse\CoreBundle\Model\FileInfo;

/**
 * Class CoreContentProvider
 *
 * @author Tobias Nyholm
 *
 *
 */
abstract class CoreContentProvider
{
    /**
     * @var string dataDir
     *
     */
    protected $dataDir;

    /**
     * @var string fileExtension
     *
     */
    protected $fileExtension;

    /**
     * @var int depth
     *
     */
    protected $depth;

    /**
     * @param string $dataDir
     * @param string $fileExtension
     * @param int $depth
     */
    public function __construct($dataDir, $fileExtension = 'txt', $depth = null)
    {
        $this->dataDir = $dataDir;
        $this->fileExtension = $fileExtension;
        $this->depth = $depth;
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

    /**
     * Get all files in dataDir
     */
    public function getAllFiles()
    {
        $finder= new Finder();
        $finder->files()->name('*.'.$this->fileExtension)->in($this->dataDir);

        if ($this->depth !== null) {
            $finder->depth($this->depth);
        }

        $files=array();
        foreach ($finder as $file) {
            $files[]= new FileInfo($file->getRealpath(), preg_replace('|\.'.$this->fileExtension.'$|', '', $file->getRelativePathname()));
        }

        return $files;
    }

    /**
     * Sort file based entries
     *
     * @param \Symfonyse\CoreBundle\Entity\FileBasedEntity[] $entries
     *
     */
    public function sortEntries(&$entries)
    {
        usort($entries, function($a, $b) {
            $timeDiff = $b->getPostedAt()->getTimestamp() - $a->getPostedAt()->getTimestamp();

            if ($timeDiff == 0){
                return strcmp($a->getAbsolutePath(), $b->getAbsolutePath());
            }

            return $timeDiff;
        });
    }

    /**
     * Get all entries of the object.
     *
     * @return array
     */
    abstract public function getAllEntries();
}