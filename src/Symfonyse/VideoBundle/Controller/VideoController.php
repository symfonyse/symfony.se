<?php

namespace Symfonyse\VideoBundle\Controller;

use Symfonyse\CoreBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfonyse\VideoBundle\Entity\Video;

/**
 * Class VideoController
 *
 * @author Tobias Nyholm
 *
 */
class VideoController extends BaseController
{
    /**
     *
     * @Template
     *
     * @Cache(expires="+2weeks", public=true)
     *
     * @return array
     */
    public function indexAction()
    {
        $videos=$this->get('symfonyse.video.content_provider')->getAllEntries();

        return array(
            'videos'=>$videos,
        );
    }

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
        if (null === $video = $this->get('symfonyse.video.content_provider')->getEntry($permalink)) {
            throw $this->createNotFoundException();
        }

        return array(
            'video'=>$video,
        );
    }
} 