<?php
namespace kingjerod\ImageTools\Modifier;

use kingjerod\ImageTools\Image\Image;
use Imagick;

/**
 * Class Scale
 * This modifier will scale an image's size, up or down. When scaling an image up, the
 * best filter is Mitchell. For down scaling, use Lanczos. If these filters are taking
 * too long, use Gaussian.
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

    public function __construct($width, $height, $filter = self::FILTER_LANCZOS)
    {
        $this->width = $width;
        $this->height = $height;
        $this->filter = $filter;
    }

    public function modify(Image $image)
    {
        $imagick = $image->getImagick();
        $imagick->resizeImage($this->width, $this->height, $this->filter, 1);
    }
}
