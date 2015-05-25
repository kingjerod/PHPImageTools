<?php
namespace kingjerod\ImageTools\Modifier;

use kingjerod\ImageTools\Image\Image;
use Imagick;

/**
 * Class Scale
 * This modifier will scale an image's size, up or down. If not filter is given, it will attempt
 * to use the best filter depending if the image is being enlarged or shrunk.
 * @package kingjerod\ImageTools\Modifier
 */
class Scale implements ModifierInterface
{
    protected $width;
    protected $height;
    protected $filter;

    const FILTER_LANCZOS = Imagick::FILTER_LANCZOS; //Good filter for shrinking images
    const FILTER_MITCHELL = Imagick::FILTER_MITCHELL; //Good filter for enlarging images
    const FILTER_CATROM = Imagick::FILTER_CATROM; //Similar to LANCZOS, but faster
    const FILTER_GAUSSIAN = Imagick::FILTER_GAUSSIAN; //Not the best filter, but fast

    public function __construct($width, $height, $filter = null)
    {
        $this->width = $width;
        $this->height = $height;
        $this->filter = $filter;
    }

    public function modify(Image $image)
    {
        $imagick = $image->getImagick();
        $width = $imagick->getImageWidth();
        $height = $imagick->getImageHeight();

        //Figure out filter depending if shrinking or enlarging image
        $filter = $this->filter;
        if ($filter == null) {
            //Default to LANCZOS
            $filter = self::FILTER_LANCZOS;
            if ($width < $this->width && $height < $this->height) {
                //Enlarging image, use Mitchell
                $filter = self::FILTER_MITCHELL;
            }
        }
        $imagick->resizeImage($this->width, $this->height, $filter, 1);
    }
}
