<?php
namespace kingjerod\ImageTools\Modifier;

use kingjerod\ImageTools\Image\Image;

/**
 * Class Crop
 * This modifier will crop an image, cutting out a piece of it
 * @package kingjerod\ImageTools\Modifier
 */
class Crop implements ModifierInterface
{
    protected $x;
    protected $y;
    protected $width;
    protected $height;

    function __construct($x, $y, $width, $height)
    {
        $this->x = $x;
        $this->y = $y;
        $this->width = $width;
        $this->height = $height;
    }

    public function modify(Image $image)
    {
        $imagick = $image->getImagick();
        $imagick->crop($this->x, $this->y, $this->width, $this->height);
    }
}
