<?php

namespace Symfonyse\CoreBundle\Model;

/**
 * Class File
 *
 * @author Tobias Nyholm
 *
 */
class FileInfo extends \SplFileInfo
{
    /**
     * @var string permalink
     *
     */
    private $permalink;

    /**
     * @var string dataDir
     *
     */
    private $dataDir;

    /**
     * @param string $path
     * @param string $permalink
     */
    public function __construct($path, $permalink)
    {
        $this->permalink = $permalink;
        $this->dataDir = $path;
        parent::__construct($path);
    }

    /**
     *
     * @return mixed
     */
    public function getPermalink()
    {
        return $this->permalink;
    }

    /**
     *
     * @return string
     */
    public function getDataDir()
    {
        return $this->dataDir;
    }

}