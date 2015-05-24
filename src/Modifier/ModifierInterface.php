<?php
namespace kingjerod\ImageTools\Modifier;

use kingjerod\ImageTools\Image\Image;

interface ModifierInterface
{
    public function modify(Image $image);
}
