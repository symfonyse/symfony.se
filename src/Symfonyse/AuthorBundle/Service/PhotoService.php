<?php

namespace Symfonyse\AuthorBundle\Service;

use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class PhotoService.
 *
 * @author Tobias Nyholm
 */
class PhotoService
{
    /**
     * @var \Symfony\Component\HttpKernel\KernelInterface kernel
     */
    private $kernel;

    /**
     * @param KernelInterface $kernel
     */
    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * Get a photo.
     *
     * @param $permalink
     *
     * @return string the path to asset
     */
    public function getPhoto($permalink)
    {
        $path = $this->getAbsolutePath($permalink);

        /*
         * Path might be: /var/www/Symfony.se/src/Symfonyse/AuthorBundle/Resources/public/images/tobias-nyholm.jpg
         * We want to return /bundles/symfonyseauthor/images/tobias-nyholm.jpg
         */
        $assetPath = preg_replace('|(?:.*?)?/([^/]*?)/([^/]*?)Bundle/Resources/public/(.*)$|si', '$1$2/$3', $path);

        return strtolower('/bundles/'.$assetPath);
    }

    private function getAbsolutePath($permalink)
    {
        $prefix = '@SymfonyseAuthorBundle/Resources/public/images/';

        try {
            return $this->kernel->locateResource($prefix.$permalink.'.jpg', null, true);
        } catch (\InvalidArgumentException $e) {
        }

        try {
            return $this->kernel->locateResource($prefix.$permalink.'.png', null, true);
        } catch (\InvalidArgumentException $e) {
        }

        try {
            return $this->kernel->locateResource($prefix.'default-photo.png', null, true);
        } catch (\InvalidArgumentException $e) {
        }

        return null;
    }
}
