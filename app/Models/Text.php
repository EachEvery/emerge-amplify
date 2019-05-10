<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class Text extends Model
{
    protected $guarded = ['id'];

    use Actionable;

    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function poems()
    {
        return $this->hasMany(Poem::class);
    }
}
