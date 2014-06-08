<?php

namespace Symfonyse\AuthorBundle\Twig;

use Symfonyse\AuthorBundle\Entity\Author;
use Symfonyse\AuthorBundle\Service\PhotoService;

/**
 * Class StaticExtension
 *
 * A twig extension to make static calls
 */
class AuthorExtension extends \Twig_Extension
{
    /**
     * @var \Symfonyse\AuthorBundle\Service\PhotoService photoService
     *
     */
    protected $photoService;

    /**
     * @param PhotoService $photoService
     */
    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }

    /**
     * Get twig filters
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('getAuthorPhoto', array($this, 'getPhoto')),
        );
    }

    /**
     * Get the photo
     *
     * @param Author $author
     *
     * @return string to be used in asset()
     */
    public function getPhoto($author)
    {
        if (is_string($author)) {
            $permalink = $author;
        } elseif ($author instanceof Author) {
            $permalink = $author->getPermalink();
        } else {
            throw new \InvalidArgumentException('First parameter to getPhoto must be an Author object or a permalink string.');
        }

        return $this->photoService->getPhoto($permalink);
    }

    /**
     * @inherit
     *
     * @return string
     */
    public function getName()
    {
        return 'symfonyse_author_author_extension';
    }
}
