<?php
namespace kingjerod\ImageTools\Modifier;

use \ImagickDraw;
use kingjerod\ImageTools\Image\Image;

/**
 * Class Text
 * This modifier will draw text onto the image. Useful for watermarks.
 * @package kingjerod\ImageTools\Modifier
 */
class Text implements ModifierInterface
{
    protected $font;
    protected $color;
    protected $opacity;
    protected $size;
    protected $text;
    protected $x;
    protected $y;
    protected $alignment;
    protected $draw;

    const LEFT = \Imagick::ALIGN_LEFT;
    const RIGHT = \Imagick::ALIGN_RIGHT;
    const CENTER = \Imagick::ALIGN_CENTER;

    /**
     * @param int $x The x placement of anchor for the text
     * @param int $y The y placement of the text (from the bottom of the text)
     * @param string $font Path to a font file
     * @param string $color Hex string for color (#FFCC00)
     * @param float $opacity The opacity of the text (1 = solid, 0 = transparent)
     * @param int $size Size of text in pixels
     * @param string $text The text to draw
     * @param int $alignment How the text should be aligned with the anchor.
     * @param ImagickDraw An ImagickDraw instance (optional)
     */
    function __construct($x, $y, $font, $color, $opacity, $size, $text, $alignment = self::LEFT, $imagickDraw = null)
    {
        $this->x = $x;
        $this->y = $y;
        $this->font = $font;
        $this->color = $color;
        $this->opacity = $opacity;
        $this->size = $size;
        $this->text = $text;
        $this->alignment = $alignment;
        $this->draw = ($imagickDraw == null) ? new ImagickDraw() : $imagickDraw;
    }

    public function modify(Image $image)
    {
        $imagick = $image->getImagick();

        /* Black text */
        $this->draw->setFillColor($this->color);

        /* Font properties */
        $this->draw->setFont($this->font);
        $this->draw->setFillOpacity($this->opacity);
        $this->draw->setFontSize($this->size);
        $this->draw->setTextAlignment($this->alignment);

        /* Create text */
        $imagick->annotateImage($this->draw, $this->x, $this->y, 0, $this->text);
    }
}
