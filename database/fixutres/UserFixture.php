<?php

namespace App\Fixtures;

use Illuminate\Contracts\Hashing\Hasher;

class UserFixture
{
    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    public function get()
    {
        return [
            [
                'name' => 'Nate Hobi',
                'email' => 'nate@natehobi.com',
                'password' => $this->hasher->make('password'),
            ],
            [
                'name' => 'Grace Leuenberger',
                'email' => 'grace@eachevery.com',
                'password' => $this->hasher->make('r3adwr!te'),
            ],
            [
                'name' => 'Alex Catanese',
                'email' => 'alex@eachevery.com',
                'password' => $this->hasher->make('r3adwr!te'),
            ],
            [
                'name' => 'Nate Mucha',
                'email' => 'nate@eachevery.com',
                'password' => $this->hasher->make('r3adwr!te'),
            ],
        ];
    }
}
