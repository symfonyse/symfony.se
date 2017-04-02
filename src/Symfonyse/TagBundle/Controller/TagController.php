<?php

namespace Symfonyse\TagBundle\Controller;

use Symfonyse\CoreBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

/**
 * Class TagController.
 *
 * @author Tobias Nyholm
 */
class TagController extends BaseController
{
    /**
     * @Template
     *
     * cache for 4 weeks
     * @Cache(smaxage=2419200)
     *
     * @return array
     */
    public function entryAction($permalink)
    {
        $cp = $this->get('symfonyse.tag.content_provider');
        if (null === $tag = $cp->getEntry($permalink)) {
            throw $this->createNotFoundException();
        }

        $entries = $cp->getEntriesByTag($tag);
        $cp->sortEntries($entries);

        return array(
            'tag' => $tag,
            'entries' => $entries,
        );
    }

    /**
     * Get all tags with count.
     *
     * @Template
     *
     * cache for 4 weeks
     * @Cache(smaxage=2419200)
     *
     * @return array
     */
    public function indexAction()
    {
        $cp = $this->get('symfonyse.tag.content_provider');
        $entries = $cp->getAllEntries();

        usort($entries, function ($a, $b) {
            $timeDiff = $b->getCount() - $a->getCount();

            if ($timeDiff == 0) {
                return strcmp($a->getTitle(), $b->getTitle());
            }

            return $timeDiff;
        });

        return array(
            'entries' => $entries,
        );
    }
}
