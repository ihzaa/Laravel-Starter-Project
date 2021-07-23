<?php

namespace App\Utils;

class ImageUploadResizeHelper
{
    public static function resizeImageAndUpload($imageRequestObject, $requiredSize, $path, $name, $generateThumbnail = true)
    {
        $image = Image::make($imageRequestObject);
        $ext = $image->getClientOriginalExtension();
        $width = $image->width();
        $height = $image->height();

        // Check if image resize is required or not
        if ($requiredSize >= $width && $requiredSize >= $height) {
            $image->save(public_path($path) . $name . '.' . $ext);
            $data['resize'] = false;
        } else {

            $newWidth = 0;
            $newHeight = 0;

            $aspectRatio = $width / $height;
            if ($aspectRatio >= 1.0) {
                $newWidth = $requiredSize;
                $newHeight = $requiredSize / $aspectRatio;
            } else {
                $newWidth = $requiredSize * $aspectRatio;
                $newHeight = $requiredSize;
            }


            $image->resize($newWidth, $newHeight);
            $image->save(public_path($path) . '/' . $name . '.' . $ext);
            $data['resize'] = true;
        }
        if ($generateThumbnail) {
            $filename_thumb = $name . '.thumb.' . $ext;
            $relativePath_thumb = $path . $filename_thumb;
            $fullPath_thumb = public_path($relativePath_thumb);

            $image->fit(200, 200)->save($fullPath_thumb);
        }
        $data['status'] =  true;
        $data['full_path'] = $path  . $name . '.' . $ext;

        return $data;
    }
}
