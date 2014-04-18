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
     * cache for 1 week and 1 hour in private cache
     * @Cache(smaxage=604800, maxage=3600)
     *
     * @return array
     */
    public function homepageAction()
    {
        return array();
    }
}
