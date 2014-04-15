<?php

namespace Symfonyse\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfonyse\BlogBundle\Entity\Entry;
use Symfonyse\CoreBundle\Controller\BaseController;

/**
 * Class BlogController
 *
 * @author Tobias Nyholm
 *
 */
class BlogController extends BaseController
{
    /**
     *
     * @Template
     *
     * @return array
     */
    public function indexAction()
    {

        return array();
    }

    /**
     *
     * @Template
     *
     * @return array
     */
    public function entryAction($permalink)
    {
        if (null === $file = $this->get('symfonyse.blog.content_provider')->getFile($permalink)) {
            throw $this->createNotFoundException();
        }

        $entry=new Entry($file);

        return array(
            'entry'=>$entry,
        );
    }
} 