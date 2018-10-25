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
        \Log::info('public/images/'.$fileUpload->image_name);

        try
        {
            // open an image file
            $img = \Image::make(public_path('images/'.$fileUpload->image_name));

            \Log::info('public/images/'.$fileUpload->image_name);

            // now you are able to resize the instance
            $img->resize(50, 50);

            // finally we save the image as a new file
            $img->save(public_path('images/thumbs/'.$fileUpload->image_name));
        }
        catch (\Exception $e)
        {
            \Log::error('thumbnail creation' , [$e->getMessage()]);
        }
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        //
    }

}