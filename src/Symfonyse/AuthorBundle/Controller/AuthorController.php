<?php

namespace Symfonyse\AuthorBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfonyse\AuthorBundle\Entity\Author;
use Symfonyse\ContentBundle\Entity\Page;
use Symfonyse\CoreBundle\Controller\BaseController;

/**
 * Class PageController
 *
 * @author Tobias Nyholm
 *
 *
 */
class AuthorController extends BaseController
{
    /**
     *
     * @Template
     *
     * @return array
     */
    public function entryAction($permalink)
    {
        if (null === $file = $this->get('symfonyse.author.content_provider')->getFile($permalink)) {
            throw $this->createNotFoundException();
        }

        $author=new Author($file);

        return array(
            'author'=>$author,
        );
    }
}
