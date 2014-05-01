<?php


namespace Symfonyse\AuthorBundle\Entity;

use Symfonyse\CoreBundle\Entity\FileBasedEntity;

/**
 * Class Author
 *
 * @author Tobias Nyholm
 *
 */
class Author extends FileBasedEntity
{
    public function getType()
    {
        return 'author';
    }

    /**
     * Get a photo
     *
     * @param $permalink
     *
     * @return string
     */
    static function getPhoto($permalink)
    {
        $path=dirname(__DIR__).'/Resources/public/images/'.$permalink;

        $photo=$path.'.jpg';
        if (file_exists($photo)) {
            return $permalink.'.jpg';
        }

        $photo=$path.'.png';
        if (file_exists($photo)) {
            return $permalink.'.png';
        }

        return 'default-photo.png';
    }
}