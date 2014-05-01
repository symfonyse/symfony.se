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
     * Show upcoming events
     *
     * @Template
     *
     * cache for 1 day
     * @Cache(smaxage=86400)
     *
     * @return array
     */
    public function indexAction()
    {
        $cp=$this->get('symfonyse.event.content_provider');
        $events=$cp->getUpcomingEvents();

        return array(
            'events'=>$events,
        );
    }

    /**
     *
     * @Template("SymfonyseEventBundle:Event:entry.html.twig")
     *
     * cache for 1 day
     * @Cache(smaxage=86400)
     *
     * @return array
     */
    public function nextEventAction()
    {
        if (null === $event = $this->get('symfonyse.event.content_provider')->getNextEvent()) {
            return $this->render('SymfonyseEventBundle:Event:no-upcoming-event.html.twig');
        }

        return array(
            'event'=>$event,
        );
    }
}
