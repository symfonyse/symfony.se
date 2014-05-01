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
     * Two weeks
     * @Cache(smaxage=1209600)
     *
     * @return array
     */
    public function entryAction($permalink)
    {
        $cp=$this->get('symfonyse.author.content_provider');
        if (null === $author = $cp->getEntry($permalink)) {
            throw $this->createNotFoundException();
        }

        $entries = $cp->getEntriesByAuthor($author);
        $cp->sortEntries($entries);

        return array(
            'author'=>$author,
            'entries'=>$entries,
        );
    }
}
