<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;
use Laravel\Nova\Actions\Actionable;
use App\Traits\ConvertsPhotoPathToUrl;

class Collection extends Model
{
    use HasUuid, Actionable, ConvertsPhotoPathToUrl;

    protected $guarded = ['id'];

    public function forScript()
    {
        return $this->append('is_portal', 'photo_url');
    }

    public function texts()
    {
        return $this->belongsToMany(Text::class);
    }

    public function poems()
    {
        return $this->hasMany(Poem::class);
    }

    public function getIsPortalAttribute()
    {
        return !empty($this->portal);
    }

    public function getUrlAttribute()
    {
        if ($this->is_portal) {
            return prepend_subdomain($this->portal);
        }

        return route('collection', ['collection' => $this]);
    }
}
