<?php
namespace kingjerod\ImageTools\Image;

use Imagick;
use GuzzleHttp\Client;
use Symfony\Component\Finder\Finder;

class ImageFactory
{
    protected $client;
    protected $finder;
    protected $imagick;

    public function __construct(Client $client = null, Finder $finder = null, Imagick $imagick = null)
    {
        $this->client = ($client == null) ? new Client() : $client;
        $this->finder = ($finder == null) ? new Finder() : $finder;
        $this->imagick = ($imagick == null) ? new Imagick() : $imagick;
    }

    /**
     * Reads an image from a remote location and creates an Image from it
     * @param $path
     * @return Image
     */
    public function createFromRemoteFile($path)
    {
        $body = $this->client->get($path)->getBody();
        $imagick = clone $this->imagick;
        $imagick->readImageBlob($body);
        return new Image($imagick);
    }

    /**
     * Creates an Image from a local file
     * @param $file
     * @return Image
     */
    public function createFromLocalFile($file)
    {
        $imagick = clone $this->imagick;
        $imagick->readImage($file);
        return new Image($imagick);
    }

    /**
     * Creates an array of Images from a directory. Uses Symfony finder to find files.
     * @param $directory Directory to look in
     * @param string $imageName A regex style filter for file names, such as photo*.png
     * @return array
     */
    public function createFromDirectory($directory, $imageName = "*")
    {
        $images = [];
        $finder = $this->finder->create();
        $files = $finder->files()->in($directory)->name($imageName);
        foreach ($files as $file) {
            $images []= $this->createFromLocalFile($file->getRealpath());
        }
        return $images;
    }

    /**
     * Creates a simple empty image. Default background is transparent ("none")
     * @param $width
     * @param $height
     * @param string $background
     * @return Image
     */
    public function createEmptyImage($width, $height, $background = "none")
    {
        $imagick = clone $this->imagick;
        $imagick->newImage($width, $height, $background);
        return new Image($imagick);
    }
}
