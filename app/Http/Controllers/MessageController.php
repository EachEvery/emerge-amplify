<?php

namespace App\Http\Controllers;

use App\Http\Requests\Messages\StoreMessageRequest;
use App\Repositories\MessageRepository;

class MessageController extends Controller
{
    public function __construct(MessageRepository $messages)
    {
        $this->messages = $messages;
    }

    public function store(StoreMessageRequest $req)
    {
        return $this->messages->create($req->message);
    }
}
