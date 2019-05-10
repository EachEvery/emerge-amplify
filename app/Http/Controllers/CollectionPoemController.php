<?php

namespace App\Http\Controllers;

use App\Repositories\CollectionRepository as Collections;
use App\Repositories\PoemRepository as Poems;
use Illuminate\Http\Request;

class CollectionPoemController
{
    public function __construct(Collections $collections, Poems $poems)
    {
        $this->collections = $collections;
        $this->poems = $poems;
    }

    public function index(Request $req)
    {
        return $this->poems->fromCollection(
            $this->collections->find($req->collection_id)
        );
    }
}
