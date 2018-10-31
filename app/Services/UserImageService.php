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
use App\FileShares;


class UserImageService
{

    public function getAllUserImages($user)
    {
        $user = User::with('userImages' , 'userImages.share')->find($user->id);

        return $user->userImages;
    }

    public function createUserImage($userId,$uploadImage)
    {
        $image= new FileUpload();
        $image->image_name = basename($uploadImage);
        $image->user_id = $userId;
        $image->path = basename($uploadImage);
        $image->save();
    }

    public function updateUserImage($userImageId,$newImageName)
    {
       $userImage = FileUpload::find($userImageId);
       $userImage->image_name = $newImageName;
       $userImage->save();
    }

    public function deleteUserImage($userImageId)
    {
        $userImage = FileUpload::find($userImageId);
        $userImage->delete();
    }

    public function getUserImage($imageId)
    {
        return FileUpload::find($imageId);
    }

    public function shareUserImage($userImageId,$shareImageEmail)
    {
       $shareImage = new FileShares();
       $shareImage->file_id = $userImageId;
       $shareImage->email  = $shareImageEmail;
       $shareImage->save();
    }

}