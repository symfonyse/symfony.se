<?php

namespace Symfonyse\EventBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfonyse\CoreBundle\Controller\BaseController;
use Symfonyse\EventBundle\Entity\Event;

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
     * @return array
     */
    public function indexAction()
    {
        $events=$this->get('symfonyse.event.content_provider')->getAllEntries();

        return array(
            'events'=>$events,
        );
    }

    /**
     *
     * @Template
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
