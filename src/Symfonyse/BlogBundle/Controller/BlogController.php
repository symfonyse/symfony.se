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
     * @Cache(expires="+2weeks", public=true)
     *
     * @return array
     */
    public function indexAction()
    {
        $entries=$this->get('symfonyse.blog.content_provider')->getAllEntries();

        return array(
            'entries'=>$entries,
        );
    }

    /**
     *
     * @Template
     *
     * @Cache(expires="+1week", public=true)
     *
     * @return array
     */
    public function entryAction($permalink)
    {
        if (null === $entry = $this->get('symfonyse.blog.content_provider')->getEntry($permalink)) {
            throw $this->createNotFoundException();
        }

        return array(
            'entry'=>$entry,
        );
    }
} 