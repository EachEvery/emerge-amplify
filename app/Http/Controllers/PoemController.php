<?php

namespace App\Http\Controllers;

use App\Repositories\PoemRepository as Poems;
use App\Repositories\AttachmentRepository as Attachments;
use App\Http\Requests\Poems\StorePoemRequest;
use App\Http\Requests\Poems\PoemQueryRequest;
use App\Http\Requests\Poems\ShowPoemRequest;

class PoemController
{
    public function __construct(Poems $poems, Attachments $attachments)
    {
        $this->poems = $poems;
        $this->attachments = $attachments;
    }

    public function store(StorePoemRequest $req)
    {
        $path = $this->attachments->uploadBase64($req->base64);

        return $this->poems->store(array_merge(
            $req->poem,
            ['photo' => $path]
        ));
    }

    public function index(PoemQueryRequest $req)
    {
        return $this->poems->matchingQuery($req->input());
    }

    public function show(ShowPoemRequest $req)
    {
        return $this->poems->findOrFail($req->poem_id);
    }
}
