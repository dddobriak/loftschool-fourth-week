<?php

namespace App\Services;

use Intervention\Image\ImageManagerStatic as Image;

class ImageTask
{
    public function convert(): void
    {
        // open an image file
            $img = Image::make(ROOT . '/public/image.jpg');

            // now you are able to resize the instance
            $img->fit(200);

            // and insert a text watermark for example
            $img->text('The quick brown fox.', 190, 10, function ($font) {
                $font->file(ROOT . '/public/tahoma.ttf');
                $font->size(12);
                $font->color('#fff');
                $font->align('right');
                $font->valign('top');
            });

            // finally we save the image as a new file
            $img->save(ROOT . '/public/image_converted.jpg');
    }
}
