<?php

namespace Symfonyse\CoreBundle\Twig;

/**
 * Class StaticExtension
 *
 * A twig extension to make static calls
 */
class StaticExtension extends \Twig_Extension
{

    /**
     * @inherit
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('static', array($this, 'getStaticVar')),
            new \Twig_SimpleFunction('staticCall', array($this, 'getStaticCall')),
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
    public function getStaticVar($class, $property)
    {
        //check if static var exists
        if (property_exists($class, $property)) {
            return $class::$$property;
        }

        //check if const exists
        $constant=sprintf('%s::%s', get_class($class), $property);
        if (defined($constant)) {
            return constant($constant);
        }

        return null;
    }

    /**
     * Return the result of a call to static function
     *
     * @param string $class
     * @param string $function
     * @param mixed $args
     *
     * @return mixed|null
     */
    public function getStaticCall($class, $function, $args = null)
    {
        if (class_exists($class) && method_exists($class, $function)) {

            return $class::$function($args);
        }

        return null;
    }

    /**
     * @inherit
     *
     * @return string
     */
    public function getName()
    {
        return 'symfonyse_core_static_extension';
    }
}
