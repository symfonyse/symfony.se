<?php

namespace Symfonyse\EventBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfonyse\CoreBundle\Controller\BaseController;

/**
 * Class EventController
 *
 * @author Tobias Nyholm
 *
 *
 */
class EventController extends BaseController
{
    /**
     *
     * @Template
     *
     * cache for 1 week and 10 minutes in private cache
     * @Cache(smaxage=604800, maxage=600)
     *
     * @return array
     */
    public function indexAction()
    {
        $cp=$this->get('symfonyse.event.content_provider');
        $events=$cp->getAllEntries();

        $cp->sortEntries($events);

        return array(
            'events'=>$events,
        );
    }

    /**
     *
     * @Template
     *
     * cache for 3 days and 10 minutes in private cache
     * @Cache(smaxage=259200, maxage=3600)
     *
     * @return array
     */
    public function entryAction($permalink)
    {
        if (null === $event = $this->get('symfonyse.event.content_provider')->getEntry($permalink)) {
            throw $this->createNotFoundException();
        }

        return array(
            'event'=>$event,
        );
    }
}
