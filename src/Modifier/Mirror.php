<?php
namespace kingjerod\ImageTools\Modifier;

use kingjerod\ImageTools\Image\Image;

/**
 * Class Mirror
 * This modifier will flip the pixels in an image across the center of it, either horizontally and/or vertically.
 * @package kingjerod\ImageTools\Modifier
 */
class Mirror implements ModifierInterface
{
    protected $vertical;
    protected $horizontal;

    /**
     * @param bool $vertical Flip image vertically? (pixels on top will be on bottom and vice versa)
     * @param bool $horizontal Flip image horizontally? (pixels on left will be on right and vice versa)
     */
    public function __construct($vertical, $horizontal)
    {
        $this->vertical = $vertical;
        $this->horizontal = $horizontal;
    }

    public function modify(Image $image)
    {
        $imagick = $image->getImagick();
        if ($this->vertical) {
            $imagick->flipImage();
        }
        if ($this->horizontal) {
            $imagick->flopImage();
        }
    }
}
