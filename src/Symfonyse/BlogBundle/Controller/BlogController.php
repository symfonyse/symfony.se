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
     * cache for 2 weeks and 20 minutes in private cache
     * @Cache(smaxage=1209600, maxage=1200)
     *
     * @return array
     */
    public function indexAction()
    {
        $cp=$this->get('symfonyse.blog.content_provider');
        $entries=$cp->getAllEntries();
        $cp->sortEntries($entries);

        return array(
            'entries'=>$entries,
        );
    }

    /**
     *
     * @Template
     *
     * cache for 1 week and 1 hour in private cache
     * @Cache(smaxage=604800, maxage=3600)
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