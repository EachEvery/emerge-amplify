<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    public function initializeHasUuid()
    {
        $this->incrementing = false;
    }

    protected static function bootHasUuid()
    {
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid();
        });
    }
}
