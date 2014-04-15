<?php

namespace Bloghoven\BlogBundle\ContentProvider\Interfaces;

interface ImmutableCategoryInterface
{
  public function getName();

  public function getPermalinkId();

  public function getParent();

  public function getChildren();
}
