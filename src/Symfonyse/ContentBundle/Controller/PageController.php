<?php

namespace Symfonyse\ContentBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfonyse\ContentBundle\Entity\Page;
use Symfonyse\CoreBundle\Controller\BaseController;

/**
 * Class PageController
 *
 * @author Tobias Nyholm
 *
 *
 */
class PageController extends BaseController
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
    public function pageAction($permalink)
    {
        if (null === $file = $this->get('symfonyse.content.content_provider')->getFile($permalink)) {
            throw $this->createNotFoundException();
        }

        $page=new Page($file);

        return array(
            'page'=>$page,
        );
    }
}
