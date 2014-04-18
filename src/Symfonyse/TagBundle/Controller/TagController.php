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
     * @Cache(expires="+2weeks", public=true)
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

        return array(
            'tag'=>$tag,
            'entries'=>$entries,
        );
    }
} 