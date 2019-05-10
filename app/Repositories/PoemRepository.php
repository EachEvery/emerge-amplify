<?php

namespace App\Repositories;

use App\Models\Poem;
use App\Models\Text;
use App\Events\Poems\PoemCreated;

class PoemRepository
{
    public function count()
    {
        return Poem::count();
    }

    public function store($data)
    {
        return tap(Poem::create($data), function ($poem) {
            event(new PoemCreated($poem));
        });
    }

    public function fromCollection(Collection $collection)
    {
        return $collection->poems->latest();
    }

    public function findOrFail($id)
    {
        return Poem::with('text', 'text.category', 'collection')->findOrFail($id);
    }

    public function random()
    {
        return Poem::inRandomOrder()->first();
    }

    public function matchingQuery($query)
    {
        $textConstraints = array_only($query, ['author']);
        $textQuery = Text::latest();
        $poemQuery = Poem::latest()->with('text', 'text.category', 'collection');

        if (array_key_exists('title', $query)) {
            $title = $query['title'];
            $poemQuery = $poemQuery->where('title', 'like', "%$title%");
        }

        if (array_key_exists('collection_id', $query)) {
            $poemQuery = $poemQuery->where('collection_id', $query['collection_id']);
        }

        foreach ($textConstraints as $key => $value) {
            $textQuery = $textQuery->where($key, $value);
        }

        return $poemQuery->whereIn('text_id', $textQuery->pluck('id'))->get();
    }
}
