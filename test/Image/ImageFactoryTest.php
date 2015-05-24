<?php
namespace kingjerod\ImageTools\Image;

use Mockery as m;

class ImageFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected $client;
    protected $finder;
    protected $imagick;
    protected $factory;

    public function setup()
    {
        $this->client = m::mock('GuzzleHttp\Client');
        $this->finder = m::mock('Symfony\Component\Finder\Finder');
        $this->imagick = m::mock('Imagick');
        $this->factory = new ImageFactory($this->client, $this->finder, $this->imagick);
    }

    public function testCreateFromRemoteFile()
    {
        $body = 123;
        $this->client->shouldReceive('get->getBody')->andReturn($body);
        $this->imagick->shouldReceive('readimageblob')->with($body);
        $image = $this->factory->createFromRemoteFile('http://fake.url');
        $this->assertInstanceOf('kingjerod\ImageTools\Image\Image', $image);
    }

    public function testCreateFromLocalFile()
    {
        $file = '/dev/null/123.png';
        $this->imagick->shouldReceive('readimage')->with($file);
        $image = $this->factory->createFromLocalFile($file);
        $this->assertInstanceOf('kingjerod\ImageTools\Image\Image', $image);
    }

    public function testCreateFromDirectory()
    {
        $factoryArgs = [$this->client, $this->finder, $this->imagick];
        $factory = m::mock('kingjerod\ImageTools\Image\ImageFactory[createFromLocalFile]', $factoryArgs);
        $directory = '/dev/null';
        $name = "*.png";

        $file = m::mock('SplFileInfo');
        $file->shouldReceive('getRealPath')->andReturn('1.png');

        $this->finder->shouldReceive('create')->andReturn($this->finder);
        $this->finder->shouldReceive('files')->once()->andReturnSelf();
        $this->finder->shouldReceive('in')->once()->with($directory)->andReturnSelf();
        $this->finder->shouldReceive('name')->once()->with($name)->andReturn([$file]);

        $factory->shouldReceive('createFromLocalFile')->with('1.png')->andReturn('image1');

        $images = $factory->createFromDirectory($directory, $name);
        $this->assertSame(['image1'], $images);
    }

    public function testCreateEmptyImage()
    {
        $width = 100;
        $height = 200;
        $background = "#FFC";
        $this->imagick->shouldReceive('newimage')->with($width, $height, $background);
        $image = $this->factory->createEmptyImage($width, $height, $background);
        $this->assertInstanceOf('kingjerod\ImageTools\Image\Image', $image);
    }
}
