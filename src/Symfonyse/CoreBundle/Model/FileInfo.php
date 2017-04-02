<?php

namespace Symfonyse\CoreBundle\Model;

/**
 * Class File.
 *
 * @author Tobias Nyholm
 */
class FileInfo extends \SplFileInfo
{
    /**
     * @var string permalink
     *
     * This is the path relative the dataDir. This might contain slashes
     */
    private $permalink;

    /**
     * @param string $fullPath
     * @param string $permalink
     */
    public function __construct($fullPath, $permalink)
    {
        $this->permalink = $permalink;
        parent::__construct($fullPath);
    }

    /**
     * @return string
     */
    public function getPermalink()
    {
        return $this->permalink;
    }

    /**
     * Get the content of the file.
     *
     * @return string
     */
    public function getContent()
    {
        return file_get_contents($this->getRealPath());
    }
}
