<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;
use App\Traits\ConvertsPhotoPathToUrl;

class Poem extends Model
{
    use Actionable, ConvertsPhotoPathToUrl;

    protected $guarded = ['id'];

    public function text()
    {
        return $this->belongsTo(Text::class);
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function getPublicUrlAttribute()
    {
        return sprintf('%s#/poems/%s', $this->collection->url, $this->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => $this->author,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);
    }
}
