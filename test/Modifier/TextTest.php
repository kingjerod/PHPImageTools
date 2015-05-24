<?php
namespace kingjerod\ImageTools\Modifier;

use Mockery as m;

class TextTest extends \PHPUnit_Framework_TestCase
{
    public function testModify()
    {
        $font = 'font1.tff';
        $color = "#CDE";
        $opacity = 0.7;
        $size = 30;
        $text = "This is only a test";
        $x = 100;
        $y = 25;
        $alignment = Text::CENTER;

        $image = m::mock('kingjerod\ImageTools\Image\Image');
        $imagick = m::mock('Imagick');
        $image->shouldReceive('getImagick')->once()->andReturn($imagick);

        $draw = m::mock('ImagickDraw');
        $draw->shouldReceive('setfillcolor')->with($color)->once();
        $draw->shouldReceive('setfont')->with($font)->once();
        $draw->shouldReceive('setfillopacity')->with($opacity)->once();
        $draw->shouldReceive('setfontsize')->with($size)->once();
        $draw->shouldReceive('settextalignment')->with($alignment)->once();

        $imagick->shouldReceive('annotateimage')->with($draw, $x, $y, 0, $text)->once();
        $text = new Text($x, $y, $font, $color, $opacity, $size, $text, $alignment, $draw);
        $text->modify($image);
    }
}
