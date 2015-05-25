<?php
namespace kingjerod\ImageTools\Modifier;

use Imagick;
use kingjerod\ImageTools\Image\Image;

/**
 * Class Merge
 * This modifier will merge an image into another at the target X,Y coordinates
 * @package kingjerod\ImageTools\Modifier
 */
class Merge implements ModifierInterface
{
    protected $image;
    protected $x;
    protected $y;

    public function __construct($x, $y, $image)
    {
        $this->x = $x;
        $this->y = $y;
        $this->image = $image;
    }

    public function modify(Image $image)
    {
        $imagick = $image->getImagick();
        $imagick->compositeImage($this->image->getImagick(), Imagick::COMPOSITE_DEFAULT, $this->x, $this->y);
    }
}
