<?php
namespace kingjerod\ImageTools\Modifier;

use Mockery as m;

class ScaleTest extends \PHPUnit_Framework_TestCase
{
    public function testModifyShrinkingImage()
    {
        $width = 100;
        $height = 35;
        $image = m::mock('kingjerod\ImageTools\Image\Image');
        $imagick = m::mock('Imagick');
        $image->shouldReceive('getImagick')->once()->andReturn($imagick);
        $imagick->shouldReceive('getimagewidth')->andReturn(200);
        $imagick->shouldReceive('getimageheight')->andReturn(200);
        $imagick->shouldReceive('resizeimage')->with($width, $height, Scale::FILTER_LANCZOS, 1)->once();
        $scale = new Scale($width, $height);
        $scale->modify($image);
    }

    public function testModifyEnlarginImage()
    {
        $width = 400;
        $height = 400;
        $image = m::mock('kingjerod\ImageTools\Image\Image');
        $imagick = m::mock('Imagick');
        $image->shouldReceive('getImagick')->once()->andReturn($imagick);
        $imagick->shouldReceive('getimagewidth')->andReturn(200);
        $imagick->shouldReceive('getimageheight')->andReturn(200);
        $imagick->shouldReceive('resizeimage')->with($width, $height, Scale::FILTER_MITCHELL, 1)->once();
        $scale = new Scale($width, $height);
        $scale->modify($image);
    }
}
