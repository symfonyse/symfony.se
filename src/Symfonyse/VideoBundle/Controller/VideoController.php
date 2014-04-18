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
        if (null === $file = $this->get('symfonyse.video.content_provider')->getFile($permalink)) {
            throw $this->createNotFoundException();
        }

        $video=new Video($file);

        return array(
            'video'=>$video,
        );
    }
} 