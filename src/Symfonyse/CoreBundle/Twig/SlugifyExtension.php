<?php

namespace Symfonyse\CoreBundle\Twig;

/**
 * Class SlugifyExtension
 *
 * A twig extension to make slugs
 */
class SlugifyExtension extends \Twig_Extension
{

    /**
     * @inherit
     *
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('slugify', array($this, 'getSlug')),
        );
    }

    /**
     * Return the value of the static variable or null if not found
     *
     * @param string $class
     * @param string $property
     *
     * @return mixed|null
     */
    public function getSlug($string)
    {
        $string=strtolower($string);

        $replace=array(
            'å'=>'a',
            'ä'=>'a',
            'ö'=>'o',
            ' '=>'-',
        );

        return str_replace(array_keys($replace), array_values($replace), $string);
    }



    /**
     * @inherit
     *
     * @return string
     */
    public function getName()
    {
        return 'symfonyse_core_slugify_extension';
    }
}
