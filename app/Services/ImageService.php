<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

/**
 * Class ImageService
 * @package App\Services
 */
class ImageService
{
    /**
     * @param $image
     * @param $path
     * @param $imageFileName
     * @param string $repo
     * @return string
     */
    public static function savePhoto($image, $path, $imageFileName, $repo = 'public')
    {
        $publicDisk = Storage::disk($repo);
        $filePath = $path . '/' . $imageFileName;
        $publicDisk->put($filePath, file_get_contents($image), 'public');

        return $filePath;
    }

    /**
     * @param $input
     * @param $path
     * @param $name
     * @param $repo
     * @param $width
     * @return string
     */
    public static function attachment($input, $path, $name, $repo, $width)
    {
        try {
            $img = Image::make($input)->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            })->response();
            $s3 = Storage::disk('public');
            $filePath = "$path/thumb/" . $name;
            $s3->put($filePath, $img->getContent(), 'public');
            return $filePath;

        } catch (\Exception $e) {}
    }
}
