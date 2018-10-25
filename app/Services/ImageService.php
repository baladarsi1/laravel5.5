<?php
/**
 * Created by PhpStorm.
 * User: Kamepalli
 * Date: 25/10/18
 * Time: 9:18 AM
 */

namespace App\Services;

class ImageService
{

    public function createImage($requestImage,$imageName,$imagePath)
    {
        \Image::make($requestImage)->save(public_path($imagePath).$imageName);
    }

    public function editImage()
    {

    }

    public function deleteImage()
    {

    }

}