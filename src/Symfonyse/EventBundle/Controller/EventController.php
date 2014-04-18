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

        return array();
    }

    /**
     *
     * @Template
     *
     * @return array
     */
    public function entryAction($permalink)
    {
        if (null === $file = $this->get('symfonyse.event.content_provider')->getFile($permalink)) {
            throw $this->createNotFoundException();
        }

        $event=new Event($file);

        return array(
            'event'=>$event,
        );
    }
}
