<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Reply;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * Persist a new reply.
    *
    * @param integer $channelId
    * @param Thread $thread
    * @return Illuminate\Http\RedirectResponse
    */
    public function store($channelId, Thread $thread) {
        $this->validate(request(), ['body' => 'required']);
        $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);
        return back();
    }

    public function destroy(Reply $reply)
    {
        if ($reply->id !== auth()->id()) {
            return response([], 403);
        }
        $reply->delete();

        return back();
    }
}
