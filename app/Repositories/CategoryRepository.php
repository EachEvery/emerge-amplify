<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function create($data)
    {
        return Category::create($data);
    }

    public function findBySlug($slug)
    {
        return Category::whereSlug($slug)->first();
    }
}
