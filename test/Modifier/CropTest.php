<?php
namespace kingjerod\ImageTools\Modifier;

use Mockery as m;

class CropTest extends \PHPUnit_Framework_TestCase
{
    public function testModify()
    {
        $x = 10;
        $y = 20;
        $width = 202;
        $height = 34;
        $image = m::mock('kingjerod\ImageTools\Image\Image');
        $imagick = m::mock('Imagick');
        $image->shouldReceive('getImagick')->once()->andReturn($imagick);
        $imagick->shouldReceive('crop')->with($x, $y, $width, $height)->once();
        $crop = new Crop($x, $y, $width, $height);
        $crop->modify($image);
    }
}
