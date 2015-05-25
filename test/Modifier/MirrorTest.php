<?php
namespace kingjerod\ImageTools\Modifier;

use Mockery as m;

class MirrorTest extends \PHPUnit_Framework_TestCase
{
    public function testModifyBoth()
    {
        $image = m::mock('kingjerod\ImageTools\Image\Image');
        $imagick = m::mock('Imagick');
        $image->shouldReceive('getImagick')->once()->andReturn($imagick);
        $imagick->shouldReceive('flipimage')->once();
        $imagick->shouldReceive('flopimage')->once();
        $mirror = new Mirror(true, true);
        $mirror->modify($image);
    }

    public function testModifyVertical()
    {
        $image = m::mock('kingjerod\ImageTools\Image\Image');
        $imagick = m::mock('Imagick');
        $image->shouldReceive('getImagick')->once()->andReturn($imagick);
        $imagick->shouldReceive('flipimage')->once();
        $imagick->shouldReceive('flopimage')->never();
        $mirror = new Mirror(true, false);
        $mirror->modify($image);
    }

    public function testModifyHorizontal()
    {
        $image = m::mock('kingjerod\ImageTools\Image\Image');
        $imagick = m::mock('Imagick');
        $image->shouldReceive('getImagick')->once()->andReturn($imagick);
        $imagick->shouldReceive('flipimage')->never();
        $imagick->shouldReceive('flopimage')->once();
        $mirror = new Mirror(false, true);
        $mirror->modify($image);
    }

    public function testModifyNeither()
    {
        $image = m::mock('kingjerod\ImageTools\Image\Image');
        $imagick = m::mock('Imagick');
        $image->shouldReceive('getImagick')->once()->andReturn($imagick);
        $imagick->shouldReceive('flipimage')->never();
        $imagick->shouldReceive('flopimage')->never();
        $mirror = new Mirror(false, false);
        $mirror->modify($image);
    }
}
