<?php

namespace App\Http\Controllers;

use App\Repositories\CollectionRepository as Collections;
use App\Http\Requests\PortalRequest as Request;

class PortalController
{
    public function __construct(Collections $collections, Request $req)
    {
        $this->collections = $collections;
        $this->req = $req;
    }

    public function __invoke()
    {
        $collection = $this->req->portal()->load('texts', 'texts.category');

        return view('emerge', [
            'collection' => $collection->forScript(),
            'is_portal' => true,
        ]);
    }
}
