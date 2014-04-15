<?php

namespace Symfonyse\BlogBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfonyse\CoreBundle\Controller\BaseController;

/**
 *
 */
class EntryController extends BaseController
{
    public function permalinkAction($permalink_id)
    {
        $entry = $this->get('bloghoven.content_provider')->getEntryWithPermalinkId($permalink_id);

        if (!$entry) {
            throw new NotFoundHttpException();
        }

        return $this->render('SymfonyseAbstractThemeBundle:Permalink:permalink.html.twig', array('entry' => $entry));
    }
}
