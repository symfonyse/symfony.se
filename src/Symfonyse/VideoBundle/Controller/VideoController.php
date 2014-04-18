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
     * cache for 2 weeks and 60 minutes in private cache
     * @Cache(smaxage=1209600, maxage=3600)
     *
     * @return array
     */
    public function indexAction()
    {
        $cp=$this->get('symfonyse.video.content_provider');
        $videos=$cp->getAllEntries();

        $cp->sortEntries($videos);

        return array(
            'videos'=>$videos,
        );
    }

    /**
     *
     * @Template
     *
     * cache for 1 week and 20 minutes in private cache
     * @Cache(smaxage=604800, maxage=1200)
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