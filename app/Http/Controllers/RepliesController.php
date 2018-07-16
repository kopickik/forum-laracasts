<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Reply;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * Fetch all relevant replies.
     *
     * @param int $channelId
     * @param Thread $thread
     */
    public function index($channelId, Thread $thread)
    {
        return $thread->replies()->paginate(15);
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

        return back()
            ->with('flash', [
                'message' => "Reply added to {$thread->title}.",
                'severity' => "success"
            ]);
    }

    /**
     * Update an existing reply.
     *
     * @param Reply $reply
     */
    public function update(Reply $reply)
    {
        $this->authorize('update', $reply);
        $reply->update(request()->validate(['body' => 'required']));
    }

    /**
     * Remove the reply from storage.
     *
     * @param Reply $reply
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Reply $reply) {

        $this->authorize('update', $reply);

        $reply->delete();

        if (request()->expectsJson()) {
            return response(['status' => 'Reply deleted.']);
        }

        return back()
            ->with('flash', [
                'severity' => 'danger',
                'message' => 'Reply removed.'
            ]);
    }

}
