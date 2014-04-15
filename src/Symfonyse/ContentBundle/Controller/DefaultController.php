<?php

namespace Symfonyse\ContentBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfonyse\CoreBundle\Controller\BaseController;

/**
 * Class DefaultController
 *
 * @author Tobias Nyholm
 *
 *
 */
class DefaultController extends BaseController
{
    /**
     *
     * @Template
     *
     * @return array
     */
    public function homepageAction()
    {

        return array();
    }
}
