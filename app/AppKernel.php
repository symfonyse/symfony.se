<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            new Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),
            new DMS\Bundle\MeetupApiBundle\DMSMeetupApiBundle(),
            new HappyR\SlugifyBundle\HappyRSlugifyBundle(),
            new Debril\RssAtomBundle\DebrilRssAtomBundle(),

            new Symfonyse\ContentBundle\SymfonyseContentBundle(),
            new Symfonyse\BlogBundle\SymfonyseBlogBundle(),
            new Symfonyse\VideoBundle\SymfonyseVideoBundle(),
            new Symfonyse\AuthorBundle\SymfonyseAuthorBundle(),
            new Symfonyse\CoreBundle\SymfonyseCoreBundle(),
            new Symfonyse\EventBundle\SymfonyseEventBundle(),
            new Symfonyse\TagBundle\SymfonyseTagBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
