<?php
namespace kingjerod\ImageTools\Image;

use Mockery as m;

class ImageTest extends \PHPUnit_Framework_TestCase
{
    protected $image;
    protected $imagick;

    public function setup()
    {
        $this->imagick = m::mock('Imagick');
        $this->image = new Image($this->imagick);
    }

    public function testModify()
    {
        $modifier = m::mock('kingjerod\ImageTools\Modifier\Crop');
        $modifier->shouldReceive('modify')->with($this->image);
        $this->image->modify($modifier);
    }

    public function testGetImagick()
    {
        $this->assertSame($this->imagick, $this->image->getImagick());
    }

    public function testSave()
    {
        $target = '/dev/null/test.png';
        $this->imagick->shouldReceive('writeimage')->with($target)->once();
        $this->image->save($target);
    }

    public function testGetImageBlob()
    {
        $blob = 123;
        $this->imagick->shouldReceive('getimageblob')->once()->andReturn($blob);
        $this->assertEquals(123, $this->image->getImageBlob());
    }
}
