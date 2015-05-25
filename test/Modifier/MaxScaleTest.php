<?php
namespace kingjerod\ImageTools\Modifier;

use Mockery as m;

class MaxScaleTest extends \PHPUnit_Framework_TestCase
{
    public function testScaleByWidth()
    {
        $maxWidth = 300;
        $maxHeight = 200;
        $image = m::mock('kingjerod\ImageTools\Image\Image');
        $imagick = m::mock('Imagick');
        $image->shouldReceive('getImagick')->twice()->andReturn($imagick);
        $imagick->shouldReceive('getimagewidth')->andReturn(600);
        $imagick->shouldReceive('getimageheight')->andReturn(200);
        $imagick->shouldReceive('resizeimage')->with(300, 100, Scale::FILTER_LANCZOS, 1)->once();
        $scale = new MaxScale($maxWidth, $maxHeight, Scale::FILTER_LANCZOS);
        $scale->modify($image);
    }

    public function testScaleByHeight()
    {
        $maxWidth = 300;
        $maxHeight = 200;
        $image = m::mock('kingjerod\ImageTools\Image\Image');
        $imagick = m::mock('Imagick');
        $image->shouldReceive('getImagick')->twice()->andReturn($imagick);
        $imagick->shouldReceive('getimagewidth')->andReturn(300);
        $imagick->shouldReceive('getimageheight')->andReturn(400);
        $imagick->shouldReceive('resizeimage')->with(150, 200, Scale::FILTER_LANCZOS, 1)->once();
        $scale = new MaxScale($maxWidth, $maxHeight, Scale::FILTER_LANCZOS);
        $scale->modify($image);
    }
}
