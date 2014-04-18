<?php


namespace Symfonyse\CoreBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class BaseTestCase
 *
 * @author Tobias Nyholm
 *
 */
class BaseTestCase extends WebTestCase
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface container
     *
     */
    private $container = null;

    /**
     * @var \Symfony\Bundle\FrameworkBundle\Client client
     *
     */
    private $client = null;


    /**
     * Generates a URL from the given parameters.
     *
     * @param string         $route         The name of the route
     * @param mixed          $parameters    An array of parameters
     * @param Boolean|string $referenceType The type of reference (one of the constants in UrlGeneratorInterface)
     *
     * @return string The generated URL
     *
     * @see UrlGeneratorInterface
     */
    public function generateUrl($route, $parameters = array(), $referenceType = false)
    {
        return $this->get('router')->generate($route, $parameters, $referenceType);
    }

    /**
     * This is alias for container->get()
     *
     * @param string $service
     *
     * @return mixed
     */
    protected function get($service)
    {
        return $this->getContainer()->get($service);
    }

    /**
     * Returns a client
     * If this function is called multiple times it will return the same client.
     *
     *
     * @param bool $forceNewClient
     *
     * @return null|\Symfony\Bundle\FrameworkBundle\Client
     */
    protected function getClient($forceNewClient = false)
    {
        if ($forceNewClient || $this->client == null) {
            $this->client = static::createClient();
        }

        return $this->client;
    }

    /**
     * Returns a container
     *
     *
     * @return null|\Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected function getContainer()
    {
        if ($this->container == null) {
            $this->container = $this->getClient()->getContainer();
        }

        return $this->container;
    }
} 