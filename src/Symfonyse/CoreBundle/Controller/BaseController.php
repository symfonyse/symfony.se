<?php

namespace Symfonyse\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class BaseController
 *
 * @author Tobias Nyholm
 *
 */
abstract class BaseController extends Controller
{
    /**
     * Get the entity manager
     *
     * @param string $name (optional)
     *
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    protected function getEntityManager($name = null)
    {
        return $this->getDoctrine()->getManager($name);
    }

    /**
     * Return a repository for that entity
     *
     * @param string $entity
     * @param \Doctrine\Common\Persistence\ObjectManager $em (optional)
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function getRepo($entity, $em = null)
    {
        if (!$em) {
            $em = $this->getEntityManager();
        }

        return $em->getRepository($entity);
    }
} 