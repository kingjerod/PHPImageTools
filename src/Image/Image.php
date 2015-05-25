<?php
namespace kingjerod\ImageTools\Image;

use Imagick;
use kingjerod\ImageTools\Modifier\ModifierInterface;

class Image
{
    /**
     * @var Imagick
     */
    protected $imagick;

    public function __construct(Imagick $imagick)
    {
        $this->imagick = $imagick;
    }

    /**
     * Applies a modifier to the image
     * @param $modifier
     */
    public function modify(ModifierInterface $modifier)
    {
        $modifier->modify($this);
    }

    /**
     * Returns the Imagick instance
     * @return Imagick
     */
    public function getImagick()
    {
        return $this->imagick;
    }

    /**
     * Saves the image to the target location
     * @param $target
     */
    public function save($target)
    {
        $this->imagick->writeImage($target);
    }

    /**
     * Gets the raw image data
     */
    public function getImageBlob()
    {
        return $this->imagick->getImageBlob();
    }
}
