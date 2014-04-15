<?php

namespace Symfonyse\CoreBundle\Entity;

use Symfonyse\CoreBundle\ContentProvider\CoreContentProvider;
use Symfonyse\CoreBundle\Model\FileInfo;

/**
 *
 */
abstract class FileBasedEntity
{
    protected $fileInfo;

    public function __construct(FileInfo $file)
    {
        $this->fileInfo = $file;
    }

    public function getAbsolutePath()
    {
        return $this->fileInfo->getPathname();
    }

    protected function getRelativePath()
    {
        $full_path = $this->fileInfo->getPath();

        if (substr($full_path, 0, strlen($this->fileInfo->getDataDir())) == $this->fileInfo->getDataDir()) {
            return trim(substr($full_path, strlen($this->fileInfo->getDataDir())), '/');
        } else {
            throw new \RuntimeException("Path of entry is not as expected");
        }
    }

    protected function getRelativePathname()
    {
        $full_path = $this->fileInfo->getPathname();

        if (substr($full_path, 0, strlen($this->fileInfo->getDataDir())) == $this->fileInfo->getDataDir()) {
            return trim(substr($full_path, strlen($this->fileInfo->getDataDir())), '/');
        } else {
            throw new \RuntimeException("Path of entry is not as expected");
        }
    }
}
