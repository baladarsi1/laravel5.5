<?php
/**
 * Created by PhpStorm.
 * User: Kamepalli
 * Date: 25/10/18
 * Time: 10:17 AM
 */

namespace App\Observers;

use App\FileUpload;

class FileUploadObserver
{

    /**
     * Listen to the User created event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(FileUpload $fileUpload)
    {
        try
        {
            // open an image file
            $img = \Image::make(public_path('images/'.$fileUpload->image_name));

            // now you are able to resize the instance
            $img->resize(50);

            // finally we save the image as a new file
            $img->save(public_path('images/thumbs/'.$fileUpload->image_name));
        }
        catch (\Exception $e)
        {
            \Log::error('thumbnail creation' , [$e->getMessage()]);
        }
    }

    public function deleting(FileUpload $fileUpload)
    {

        \Log::error('image deleting observer' , [$fileUpload]);

        try
        {
            // open an image file
            $mainImg = \Image::make(public_path('images/'.$fileUpload->image_name));

            // finally delete the image
            $mainImg->destroy();
        }
        catch (\Exception $e)
        {
            \Log::error('image delete' , [$e->getMessage()]);
        }

        try
        {
            // open an image thumb file
            $thumbImg = \Image::make(public_path('images/thumbs/'.$fileUpload->image_name));

            // finally delete the image
            $thumbImg->destroy();
        }
        catch (\Exception $e)
        {
            \Log::error('thumb delete' , [$e->getMessage()]);
        }
    }
}