<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class Category extends Model
{
    use Actionable;

    protected $guarded = ['id'];

    public function texts()
    {
        return $this->hasMany(Text::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($cat) {
            $cat->slug = str_slug($cat->name);
        });
    }
}
