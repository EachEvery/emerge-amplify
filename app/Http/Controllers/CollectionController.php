<?php

namespace App\Http\Controllers;

use App\Repositories\CollectionRepository as Collections;
use Illuminate\Http\Request;

class CollectionController
{
    public function __construct(Collections $collections, Request $req)
    {
        $this->collections = $collections;
        $this->req = $req;
    }

    public function __invoke()
    {
        $collection = $this->collections
            ->find($this->req->collection)
            ->load('texts', 'texts.category');

        if ($collection->is_portal) {
            abort(401);
        }

        return view('emerge', [
            'collection' => $collection->forScript(),
        ]);
    }
}
