<?php

namespace Symfonyse\TagBundle\Controller;

use Symfonyse\TagBundle\Entity\Tag;
use Symfonyse\CoreBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

/**
 * Class TagController
 *
 * @author Tobias Nyholm
 *
 */
class TagController extends BaseController
{
    /**
     *
     * @Template
     *
     * cache for 4 week and 1 hour in private cache
     * @Cache(smaxage=2419200, maxage=3600)
     *
     * @return array
     */
    public function entryAction($permalink)
    {
        $cp=$this->get('symfonyse.tag.content_provider');
        if (null === $tag = $cp->getEntry($permalink)) {
            throw $this->createNotFoundException();
        }

        $entries = $cp->getEntriesByTag($tag);
        $cp->sortEntries($entries);

        return array(
            'tag'=>$tag,
            'entries'=>$entries,
        );
    }
} 