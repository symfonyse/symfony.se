<?php

namespace Symfonyse\CoreBundle\Entity;

use Symfony\Component\Yaml\Yaml;
use Symfonyse\CoreBundle\Model\FileInfo;

/**
 * Class FileBasedEntity
 *
 * @author Tobias Nyholm
 *
 *
 */
abstract class FileBasedEntity
{
    /**
     * @var \Symfonyse\CoreBundle\Model\FileInfo fileInfo
     *
     */
    protected $fileInfo;

    /**
     * @var array meta
     *
     */
    private $meta;

    /**
     * @var string content
     *
     */
    protected $content;

    /**
     * @var bool fileLoaded
     * Use this to find if the file is loaded or not
     */
    private $fileLoaded=false;

    /**
     * @param FileInfo $file
     */
    public function __construct(FileInfo $file)
    {
        $this->fileInfo = $file;
    }

    /**
     * Get the title as string
     *
     * @return string
     */
    function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Get the type of the entity. This should be the same as the route
     *
     * @return string
     */
    abstract public function getType();

    /**
     * Get the absolute path to the file
     *
     * @return string
     */
    public function getAbsolutePath()
    {
        return $this->fileInfo->getPathname();
    }

    /**
     * Get the content of the file
     */
    public function getContent()
    {
        $this->loadFile();

        return $this->content;
    }

    /**
     * Load file.
     * Parse the meta data and get the content
     */
    protected function loadFile()
    {
        if ($this->isFileLoaded()) {
            return;
        }

        $content=$this->fileInfo->getContent();
        $matches = array();
        if (preg_match("/---(.*?)---(.*)/ms", $content, $matches)) {
            $this->meta = Yaml::parse($matches[1]);
            $this->content = trim($matches[2]);
        } else {
            $this->content = $content;
        }

        $this->content = preg_replace('|\{\%.*?\%\}|sim', '', $this->content);

        $this->fileLoaded=true;
    }

    /**
     *
     * @return boolean
     */
    public function isFileLoaded()
    {
        return $this->fileLoaded;
    }

    /**
     *
     *
     * @param $name
     * @param $value
     *
     * @return $this
     */
    public function setMeta($name, $value)
    {
        $this->meta[$name]=$value;

        return $this;
    }

    /**
     *
     *
     * @param $name
     *
     * @return mixed|null
     */
    public function getMeta($name)
    {
        $this->loadFile();
        if (!isset($this->meta[$name])) {
            return null;
        }

        return $this->meta[$name];
    }

    /**
     *
     *
     * @return \DateTime
     */
    public function getPostedAt()
    {
        $posted=$this->getMeta('published');
        if (!$posted) {
            return $this->getModifiedAt();
        }

        return new \DateTime($posted);
    }

    /**
     *
     *
     * @return \DateTime
     */
    public function getModifiedAt()
    {
        return \DateTime::createFromFormat('U', $this->fileInfo->getMTime());
    }

    /**
     * Get the title
     *
     * @return string
     */
    public function getTitle()
    {
        if (null === $title = $this->getMeta('title')) {
            return $this->getPermalink();
        }

        return $title;
    }

    /**
     * get the permalink
     *
     *
     * @return string
     */
    public function getPermalink()
    {
        return $this->fileInfo->getPermalink();
    }
}