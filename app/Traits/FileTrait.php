<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;

trait FileTrait
{
    /**
     * Save an image to a specified directory and return its path.
     *
     * @param UploadedFile $photo The uploaded image file.
     * @param string $directory The target directory to save the image in.
     * @return string The path to the saved image.
     */
    public function saveImage($photo, $directory): string
    {
        // Determine the file extension of the uploaded image.
        $extension = $photo->getClientOriginalExtension();

        // Generate a random filename with the same extension.
        $filename = Str::random(10) . '.' . $extension;

        // Create the full path to the target directory.
        $directoryPath = public_path($directory);

        // Create the full path to the image file within the directory.
        $photoPath = $directoryPath . '/' . $filename;

        // Check if the target directory exists, and create it if not.
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        // Create an image instance from the uploaded photo and perform operations.
        $image = Image::make($photo);
        $image->encode($extension, 90)->resize($image->width(), $image->height())->save($photoPath);

        // Return the path to the saved image, including the directory.
        return '/' . $directory . '/' . $filename;
    }

    public function fileSave($video, $directory)
    {
        // dd('asd');
        $videoName = Str::random(10) . '.' . $video->getClientOriginalExtension();

        $video->move(public_path() . '/' . $directory . '/', $videoName);
        return '/' . $directory . '/' . $videoName;
    }

    public function fileDelete($model, $id, $col_name)
    {
        if (!is_null($model)) {
            $model = 'App\Models' . $model;
            if (is_file(public_path($model::find($id)->$col_name))) {
                unlink(public_path() . $model::find($id)->$col_name);
            }
        } else {
            if (is_file(public_path($col_name))) {
                unlink(public_path() . $col_name);
            }
        }
        return back();
    }
}
