<?php

class ExcerptExtensionTest extends PHPUnit_Framework_TestCase
{
    public function testExcerpt()
    {
        $extension = new \Symfonyse\CoreBundle\Twig\ExcerptExtension();

        $this->assertEquals('Hello…', $extension->getExcerpt('Hello world', 5), 'Can cut text');

        $this->assertEquals(
            'Hello world',
            $extension->getExcerpt('Hello world', 100),
            'Returns the full text when shorter than limit'
        );

        $this->assertEquals(
            'Hello world',
            $extension->getExcerpt('<b>Hello world</b>', 100),
            'Returns only text when shorter than limit'
        );

        $this->assertEquals('Hello…', $extension->getExcerpt('Hello world', 6), 'Will not cut in the middle of words');

        $this->assertEquals(
            'Hello world…',
            $extension->getExcerpt('Hello world please', 15),
            'Will find the closest space'
        );

        $this->assertEquals(
            'Hello…',
            $extension->getExcerpt('<img src="hello.jpg"><div><h1>Hello world</h1></div>', 5),
            'Strips markup'
        );

        $this->assertEquals(
            'Hello…',
            $extension->getExcerpt('Hello world', 3),
            'Looks forward when cutting the first word'
        );

        $this->assertEquals('Hel…', $extension->getExcerpt('Helloworld', 3), 'Breaks word when no space is found');

        $this->assertEquals('Hello:)', $extension->getExcerpt('Hello world', 5, ':)'), 'Tail is configurable');

        $this->assertEquals(
            'Hello world',
            $extension->getExcerpt('Hello world', 11),
            'No tail is added when length matches'
        );

        $this->assertEquals(
            'Hello world',
            $extension->getExcerpt('<b>Hello world</b>', 11),
            'No tail is added when length without markup matches'
        );
    }
}