<?php

namespace App\Repositories;

use App\Models\Collection;

class CollectionRepository
{
    public function random()
    {
        return Collection::inRandomOrder()->first();
    }

    public function create($data)
    {
        return Collection::create($data);
    }

    public function find($id)
    {
        return Collection::findOrFail($id);
    }

    public function all()
    {
        return Collection::all();
    }

    public function forPortal($portal)
    {
        return Collection::where('portal', $portal)->firstOrFail();
    }
}
