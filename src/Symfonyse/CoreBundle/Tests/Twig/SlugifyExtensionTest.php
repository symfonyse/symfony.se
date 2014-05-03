<?php


namespace Symfonyse\CoreBundle\Tests\Twig;

use Symfonyse\CoreBundle\Tests\BaseTestCase;
use Symfonyse\CoreBundle\Twig\SlugifyExtension;

/**
 * Class SlugifyExtensionTest
 *
 * @author Tobias Nyholm
 *
 */
class SlugifyExtensionTest extends BaseTestCase
{
    public function testGetSlug()
    {
        $twigExt = new SlugifyExtension();

        $this->assertEquals('tast', $twigExt->getSlug('täst'));
        $this->assertEquals('aao', $twigExt->getSlug('åäö'));
        $this->assertEquals('foo-bar', $twigExt->getSlug('Foo Bar'));

    }
} 