<?php


namespace Symfonyse\BlogBundle\Controller;

use Symfonyse\BlogBundle\Entity\Tag;
use Symfonyse\CoreBundle\Controller\BaseController;

/**
 * Class TagController
 *
 * @author Tobias Nyholm
 *
 */
class TagController extends BaseController
{
    /**
     *
     * @Template
     *
     * @return array
     */
    public function entriesAction($permalink)
    {
        if (null === $file = $this->get('symfonyse.blog.content_provider')->getFile($permalink)) {
            throw $this->createNotFoundException();
        }

        $tag=new Tag($file);

        return array(
            'tag'=>$tag,
        );
    }
} 