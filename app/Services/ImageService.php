<?php
/**
 * Created by PhpStorm.
 * User: Kamepalli
 * Date: 25/10/18
 * Time: 9:18 AM
 */

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService
{

    protected $thumbsPath = "thumbs/";

    public function createImage($image,$storagePath,$uploadPath)
    {
        return $image->store($uploadPath,$storagePath);
    }

    public function editImage($imagePath,$oldName,$newName)
    {
        rename($imagePath.$oldName, $imagePath.$newName);

        rename($imagePath.$this->thumbsPath.$oldName, $imagePath.$this->thumbsPath.$newName);
    }
}