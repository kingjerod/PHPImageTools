<?php
namespace kingjerod\ImageTools\Modifier;

use Mockery as m;
use Imagick;

class MergeTest extends \PHPUnit_Framework_TestCase
{
    public function testModify()
    {
        $x = 10;
        $y = 20;
        $image1 = m::mock('kingjerod\ImageTools\Image\Image');
        $image2 = m::mock('kingjerod\ImageTools\Image\Image');
        $imagick = m::mock('Imagick');
        $image1->shouldReceive('getImagick')->once()->andReturn($imagick);
        $image2->shouldReceive('getImagick')->once()->andReturn($imagick);
        $imagick->shouldReceive('compositeimage')->with($imagick, Imagick::COMPOSITE_DEFAULT, $x, $y)->once();
        $merge = new Merge($x, $y, $image1);
        $merge->modify($image2);
    }
}
