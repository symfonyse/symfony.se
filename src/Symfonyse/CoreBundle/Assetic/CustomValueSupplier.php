<?php

namespace Symfonyse\CoreBundle\Assetic;

use Symfony\Bundle\AsseticBundle\DefaultValueSupplier;

/**
 * Class CustomValueSupplier
 *
 * @author Tobias Nyholm
 *
 * See more documentation at http://developer.happyr.se/rename-dump-from-asseticbundle
 */
class CustomValueSupplier extends DefaultValueSupplier
{
    /**
     * Get values for Assetic
     *
     * @return array
     */
    public function getValues()
    {
        //get the default values
        $values = parent::getValues();

        //get the git version as version
        $values['version']=$this->container->getParameter('git_commit');

        return $values;
    }
}