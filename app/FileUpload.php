<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    /**
     * Get the image share record from FileShares.
     */
    public function share()
    {
        return $this->hasOne('App\FileShares', 'file_id');
    }
}
