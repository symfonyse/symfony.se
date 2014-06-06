<?php

namespace Symfonyse\VideoBundle\Controller;

use Symfonyse\CoreBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

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
     * cache for 2 weeks
     * @Cache(smaxage=1209600)
     *
     * @return array
     */
    public function indexAction()
    {
        $cp=$this->get('symfonyse.video.content_provider');
        $videos=$cp->getAllEntries();

        $cp->sortEntries($videos, 'getRecordedAt');

        return array(
            'videos'=>$videos,
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
        if (null === $video = $this->get('symfonyse.video.content_provider')->getEntry($permalink)) {
            throw $this->createNotFoundException();
        }

        return array(
            'video'=>$video,
        );
    }
} 