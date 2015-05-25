<?php
namespace kingjerod\ImageTools\Modifier;

use kingjerod\ImageTools\Image\Image;

/**
 * Class PercentScale
 * This modifier will scale an image based on percentages.
 * Example: Image with 500w x 100h, with 0.5 width % and 0.1 height % will become 250w x 10h
 * @package kingjerod\ImageTools\Modifier
 */
class PercentScale extends Scale implements ModifierInterface
{
    protected $percentWidth;
    protected $percentHeight;
    protected $filter;

    /**
     * @param $percentWidth Percentage of width (as float, 1.0 = 100%)
     * @param $percentHeight Percentage of height (as float, 1.0 = 100%)
     * @param null $filter
     */
    public function __construct($percentWidth, $percentHeight, $filter = null)
    {
        $this->percentWidth = $percentWidth;
        $this->percentHeight = $percentHeight;
        $this->filter = $filter;
    }

    public function modify(Image $image)
    {
        $imagick = $image->getImagick();
        $width = $imagick->getImageWidth();
        $height = $imagick->getImageHeight();
        $this->height = $height * $this->percentHeight;
        $this->width = $width * $this->percentWidth;
        parent::modify($image);
    }
}
