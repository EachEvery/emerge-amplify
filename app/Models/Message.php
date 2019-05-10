<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = ['id'];

    public function poem()
    {
        return $this->belongsTo(Poem::class);
    }

    public function from()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => $this->from_name,
            'email' => $this->from_email,
        ]);
    }

    public function to()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => $this->to_name,
            'email' => $this->to_email,
        ]);
    }
}
