<?php

namespace Symfonyse\CoreBundle\Twig;

/**
 * Class ExcerptExtension
 *
 * A twig extension to create an excerpt from a piece of text
 */
class ExcerptExtension extends \Twig_Extension
{
    /**
     * @inherit
     *
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('excerpt', array($this, 'getExcerpt')),
        );
    }

    public function getExcerpt($string, $limit = 300, $tail = '…')
    {
        $string = strip_tags($string);
        $length = strlen($string);

        if ($length <= $limit) {
            return $string;
        }

        $cut = $limit;

        // Move backwards to find the closest space
        while ($cut && substr($string, $cut, 1) !== ' ') {
            $cut--;
        }

        // No space found, move forward instead
        if (!$cut) {
            $cut = $limit;

            while ($cut < $length && substr($string, $cut, 1) !== ' ') {
                $cut++;
            }

            // If the end was reached, just cut it
            if ($cut === $length) {
                $cut = false;
            }
        }

        return substr($string, 0, $cut ? $cut : $limit) . $tail;
    }


    /**
     * @inherit
     *
     * @return string
     */
    public function getName()
    {
        return 'symfonyse_core_excerpt_extension';
    }
}
