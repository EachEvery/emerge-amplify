<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ConvertsPhotoPathToUrl
{
    public function getPhotoUrlAttribute()
    {
        return Storage::disk('s3')->url($this->photo);
    }
}
