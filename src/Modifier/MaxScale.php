<?php
namespace kingjerod\ImageTools\Modifier;

use Imagick;
use kingjerod\ImageTools\Image\Image;

/**
 * Class MaxScale
 * This modifier will scale an image so that either width or height is the maxHeight or maxWidth,
 * while keeping the proportions equal.
 *
 * Example: Your image is 1000w x 600h, and you want it to be max 500w x 750h, it will scale according
 * to the width, so new width will be 500, new height will be (500/1000) * 600 = 300.
 * @package kingjerod\ImageTools\Modifier
 */
class MaxScale extends Scale implements ModifierInterface
{
    protected $maxWidth;
    protected $maxHeight;
    protected $filter;

    public function __construct($maxWidth, $maxHeight, $filter = null)
    {
        $this->maxWidth = $maxWidth;
        $this->maxHeight = $maxHeight;
        $this->filter = $filter;
    }

    public function modify(Image $image)
    {
        $imagick = $image->getImagick();
        $width = $imagick->getImageWidth();
        $height = $imagick->getImageHeight();

        $widthRatio = $this->maxWidth / $width;
        $heightRatio = $this->maxHeight / $height;

        if ($widthRatio < $heightRatio) {
            //Scale by width
            $this->height = $widthRatio * $height;
            $this->width = $this->maxWidth;
            parent::modify($image);
        } else {
            //Scale by height
            $this->width = $heightRatio * $width;
            $this->height = $this->maxHeight;
            parent::modify($image);
        }
    }
}
