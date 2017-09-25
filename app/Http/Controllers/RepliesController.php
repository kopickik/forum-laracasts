<?php

namespace Forum\Http\Controllers;

use Forum\Thread;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * Persist a new reply.
    *
    * @param Thread $thread
    * @return Illuminate\Http\RedirectResponse
    */
    public function store(Thread $thread) {
        $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);
        return back();
    }
}
