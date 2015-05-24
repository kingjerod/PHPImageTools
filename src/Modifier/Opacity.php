<?php
namespace kingjerod\ImageTools\Modifier;

use kingjerod\ImageTools\Image\Image;

/**
 * Class Opacity
 * This modifier alters the opacity/transparency of an image
 * @package kingjerod\ImageTools\Modifier
 */
class Opacity implements ModifierInterface
{
    protected $opacity;

    function __construct($opacity)
    {
        $this->opacity = $opacity;
    }

    public function modify(Image $image)
    {
        $imagick = $image->getImagick();
        $imagick->setImageOpacity($this->opacity);
    }
}
