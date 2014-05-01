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
     * cache for 2 weeks
     * @Cache(smaxage=1209600)
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
     * cache for 1 week
     * @Cache(smaxage=604800)
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

    /**
     * Get some entries for the homepage
     *
     * @Template
     *
     * cache for 2 weeks
     * @Cache(smaxage=1209600)
     *
     * @return array
     */
    public function entriesForHomepageAction()
    {
        $cp= $this->get('symfonyse.blog.content_provider');
        $events = $cp->getAllEntries();
        $cp->sortEntries($events);

        $entries=array();
        $now = new \DateTime();
        foreach ($events as $event) {
            /* @var $event \Symfonyse\EventBundle\Entity\Event */
            if ($event->getPostedAt() < $now) {
                $entries[]= $event;
            }
        }


        return array('entries'=>$entries);
    }

} 