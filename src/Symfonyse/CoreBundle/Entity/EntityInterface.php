<?php

namespace Symfonyse\CoreBundle\Entity;

interface EntityInterface
{
    public function getPermalink();

    public function getTitle();

    public function getMeta($name);

    public function getContent();
}