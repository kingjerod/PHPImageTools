<?php
namespace kingjerod\ImageTools\Modifier;

use Mockery as m;

class PercentScaleTest extends \PHPUnit_Framework_TestCase
{
    public function testModify()
    {
        $widthPercent = 0.5;
        $heightPercent = 0.1;
        $image = m::mock('kingjerod\ImageTools\Image\Image');
        $imagick = m::mock('Imagick');
        $image->shouldReceive('getImagick')->twice()->andReturn($imagick);
        $imagick->shouldReceive('getimagewidth')->andReturn(200);
        $imagick->shouldReceive('getimageheight')->andReturn(100);
        $imagick->shouldReceive('resizeimage')->with(100, 10, Scale::FILTER_LANCZOS, 1)->once();
        $scale = new PercentScale($widthPercent, $heightPercent, Scale::FILTER_LANCZOS);
        $scale->modify($image);
    }
}
