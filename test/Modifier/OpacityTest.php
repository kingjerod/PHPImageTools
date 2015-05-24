<?php
namespace kingjerod\ImageTools\Modifier;

use Mockery as m;

class OpacityTest extends \PHPUnit_Framework_TestCase
{
    public function testModify()
    {
        $opacity = 0.3;
        $image = m::mock('kingjerod\ImageTools\Image\Image');
        $imagick = m::mock('Imagick');
        $image->shouldReceive('getImagick')->once()->andReturn($imagick);
        $imagick->shouldReceive('setimageopacity')->with($opacity)->once();
        $opacity = new Opacity($opacity);
        $opacity->modify($image);
    }
}
