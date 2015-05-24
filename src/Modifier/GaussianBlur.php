<?php
namespace kingjerod\ImageTools\Modifier;

use kingjerod\ImageTools\Image\Image;

/**
 * Class GaussianBlur
 * This modifier applies a gaussian blur onto the image
 * @package kingjerod\ImageTools\Modifier
 */
class GaussianBlur implements ModifierInterface
{
    protected $radius;
    protected $sigma;
    protected $channel;

    public function __construct($radius, $sigma, $channel = \Imagick::CHANNEL_ALL)
    {
        $this->radius = $radius;
        $this->sigma = $sigma;
        $this->channel = $channel;
    }

    public function modify(Image $image)
    {
        $imagick = $image->getImagick();
        $imagick->gaussianBlurImage($this->radius, $this->sigma, $this->channel);
    }
}
