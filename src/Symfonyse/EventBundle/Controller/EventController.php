<?php

namespace Symfonyse\EventBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
     * cache for 6 hours
     * @Cache(smaxage=21600)
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
     * @Template("SymfonyseEventBundle:Event:box.html.twig")
     *
     * cache for 6 hours
     * @Cache(smaxage=21600)
     *
     * @return array
     */
    public function nextEventAction()
    {
        if (null === $event = $this->get('symfonyse.event.content_provider')->getNextEvent()) {
            return $this->render('SymfonyseEventBundle:Event:box.no-upcoming-event.html.twig');
        }

        return array(
            'event'=>$event,
        );
    }

    /**
     *
     * @Template()
     *
     * cache for 6 hours
     * @Cache(smaxage=21600)
     *
     * @return array
     */
    public function entryAction($permalink)
    {
        if (null === $event = $this->get('symfonyse.event.content_provider')->getEntry($permalink)) {
            if (null === $event = $this->get('symfonyse.event.file_content_provider')->getEntry($permalink)) {
                throw $this->createNotFoundException('Event not found');
            }
        }

        return array(
            'event'=>$event,
        );
    }
}
