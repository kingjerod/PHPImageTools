# PHPImageTools
[![Build Status](https://travis-ci.org/kingjerod/php-image-tools.png?branch=master)](https://travis-ci.org/kingjerod/php-image-tools)
[![Coverage Status](https://coveralls.io/repos/kingjerod/php-image-tools/badge.svg?branch=master)](https://coveralls.io/r/kingjerod/php-image-tools?branch=master)

PHP library for image manipulation, uses modifiers to alter images. Simplifies some of the complicatedness of Imagick. Has a factory to help load remote images, and also find/manipulate images in folders.

## Installation
This library requires PHP 5.4 and the Imagick PHP plugin to be installed. On some Unix systems this command should work:

`sudo apt-get install php5-imagick`

Once you have Imagick installed, use composer to install the library:

`composer require kingjerod\php-image-tools`

##Usage
ImageTools has two main classes, the **Image** class and the **Modifier** class. The Modifier classes are used to change an image, either through resizing, cropping or adding text. Multiple modifiers can be applied to an image, and the same modifier can be applied to multiple images. 

##Examples

###First use the factory to load an image:
```php
$factory = new ImageFactory();
$image = $factory->createFromLocalFile('/images/apple.png');
```
###Once you have the image you can use different modifiers to change it:
#####Scale an image:
```php
$scale = new Scale(200, 300); //width, height
$image->modify($scale);
$image->save('/images/appleBig.png');
```
#####Change opacity:
```php
$opacity= new Opacity(0.8); //80% opacity (mostly visible)
$image->modify($opacity);
$image->save('/images/appleBig.png');
```

#####Add a watermark:
```php
$text = new Text(10, 40, 'Arial.tff', '#000', 0.3, 24, 'Copyright XYZ');
$image->modify($text);
$image->save('/images/appleCopyright.png');
```

#####Merge two images together
```php
$image2 = $factory->createFromLocalFile('/images/orange.png');
$merge = new Merge(10, 20, $image2);
$image->modify($merge);
$image->save('/images/appleAndOrange.png');
```

#####Do a bunch of cool things
```php
$image2 = $factory->createFromLocalFile('/images/orange.png');
$merge = new Merge(10, 20, $image2);
$image->modify($merge);
$text = new Text(10, 40, 'Arial.tff', '#000', 0.3, 24, 'Copyright XYZ');
$image->modify($text);
$opacity= new Opacity(0.8); //80% opacity (mostly visible)
$image->modify($opacity);
$image->save('/images/appleAndOrangeCrazy.png');
```

##Custom Modifiers
Creating your own modifiers is easy. Simple create your own class, and implement the **ModifierInterface**. It has one function:

`public function modify(Image $image);`
