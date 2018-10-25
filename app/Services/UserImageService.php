<?php
/**
 * Created by PhpStorm.
 * User: Kamepalli
 * Date: 25/10/18
 * Time: 9:45 AM
 */

namespace App\Services;
use App\FileUpload;
use App\User;


class UserImageService
{

    public function getAllUserImages($user)
    {
        $user = User::find($user->id);

        return $user->userImages;
    }

    public function createUserImage($userId,$name)
    {
        $image= new FileUpload();
        $image->image_name = $name;
        $image->user_id = $userId;
        $image->save();
    }

    public function editUserImage()
    {

    }

    public function deleteUserImage()
    {

    }
}