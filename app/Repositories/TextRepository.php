<?php

namespace App\Repositories;

use App\Models\Text;

class TextRepository
{
    public function create($data)
    {
        return Text::create($data);
    }

    public function random($count = 5)
    {
        return Text::inRandomOrder()->limit($count)->get();
    }

    public function withTitle($title)
    {
        return Text::whereTitle($title);
    }
}
