<?php
namespace kingjerod\ImageTools\Modifier;

use Mockery as m;

class GaussianBlurTest extends \PHPUnit_Framework_TestCase
{
    public function testModify()
    {
        $radius = 100;
        $sigma = 20;
        $channel = 2;

        $image = m::mock('kingjerod\ImageTools\Image\Image');
        $imagick = m::mock('Imagick');
        $image->shouldReceive('getImagick')->once()->andReturn($imagick);
        $imagick->shouldReceive('gaussianblurimage')->with($radius, $sigma, $channel)->once();
        $blur = new GaussianBlur($radius, $sigma, $channel);
        $blur->modify($image);
    }
}
