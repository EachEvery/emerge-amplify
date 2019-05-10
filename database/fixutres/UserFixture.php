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
                'name' => 'Amplify',
                'email' => 'amplify@travelingstanzas.com',
                'password' => $this->hasher->make('ThV5PXFk'),
            ]
        ];
    }
}
