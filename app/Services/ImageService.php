<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ImageService
{
    public function downloadImage($request, $path, $check, $default)

    {
        if ($request->hasFile($check)) {
            $img = $request->$check;
            $extension = $img->getClientOriginalExtension();
            $randomName = Str::random(10);
            $imagePath = $path;
            $lastName = $randomName . "." . $extension;
            $lasPath = $imagePath . $randomName . "." . $extension;

            Image::make($img)->save($lasPath);
            return $lastName;
        } else {
            return $default;
        }
    }

    public function updateImage($request, $path, $check, $hasElement)
    {
        if ($request->hasFile($check)) {
            $img = $request->$check;
            $extension = $img->getClientOriginalExtension();
            $randomName = Str::random(10);
            $imagePath = $path;
            $lastName = $randomName . "." . $extension;
            $lasPath = $imagePath . $randomName . "." . $extension;

            Image::make($img)->save($lasPath);
            return $lastName;
        } else {
            return $hasElement;
        }

    }


    public function deleteImage($path, $element)
    {
        if (file_exists($path .  $element)) {
            unlink($path .  $element);
        }
    }
}
