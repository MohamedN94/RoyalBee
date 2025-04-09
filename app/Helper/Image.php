<?php

namespace App\Helper;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as orientateImage;

class Image
{
    public static function Images($file)
    {
        $image = new Image();
        $path = DIRECTORY_SEPARATOR . date('FY') . DIRECTORY_SEPARATOR;
        $filename = $image->generateFileName($file, $path);
        $image = orientateImage::make($file)->orientate();
        $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();
        Storage::disk('public')->put($fullPath, (string) $image->encode($file->getClientOriginalExtension()), 'public');

        return $fullPath;
    }

    private function generateFileName($file, $path)
    {
        $filename = Str::random(20);
        while (Storage::disk('public')->exists($path . $filename . '.' . $file->getClientOriginalExtension())) {
            $filename = Str::random(20);
        }
        return $filename;
    }


    public static function getImageUrl($path)
    {
        return Storage::disk('public')->url($path);
    }

    public static function image($path, $attributes = [])
    {
        $attributesString = '';

        if (!empty($attributes)) {
            foreach ($attributes as $key => $value) {
                $attributesString .= $key . '="' . $value . '" ';
            }
        }

        $url = self::getImageUrl($path);

        return $url;
    }


}
