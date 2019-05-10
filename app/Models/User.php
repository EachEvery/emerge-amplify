<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isDeveloper()
    {
        return in_array($this->email, [
            'nate@natehobi.com',
        ]);
    }

    public function routeNotificationForTwilio()
    {
        return '+1'.strval(intval(preg_replace('/[^0-9]+/', '', $this->phone), 10));
    }
}
