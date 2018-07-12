<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Channel;
use App\Filters\ThreadsFilter;
use Illuminate\Http\Request;

class ThreadsController extends Controller {
    /**
    * ThreadsController constructor.
    */
    public function __construct() {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
    * Display a listing of the resource.
    *
    * @param Channel channel
    * @param ThreadsFilter filters
    * @return \Illuminate\Http\Response
    */
    public function index(Channel $channel, ThreadsFilter $filters) {
        $threads = $this->getThreads($channel, $filters);

        if (request()->wantsJson()) {
            return $threads;
        }

        return view('threads.index', compact('threads'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create() {
        return view('threads.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return \Illuminate\Http\Response
    */
    public function store() {
        request()->validate([
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id'
            ]);

        $thread = Thread::create([
            'user_id' => auth()->id(),
            'channel_id' => request('channel_id'),
            'title' => request('title'),
            'body' => request('body')
        ]);

        if (request()->wantsJson()) {
            return response($thread, 201);
        }

        return redirect($thread->path())
            ->with('flash', 'Your thread has been published.');
    }

    /**
    * Display the specified resource.
    *
    * @param  integer  $channelId
    * @param  \App\Thread  $thread
    * @return \Illuminate\Http\Response
    */
    public function show($channelId, Thread $thread) {
        // return view('threads.show', compact('thread'));
        return view('threads.show', [
            'thread' => $thread,
            'replies' => $thread->replies()->paginate(10)
        ]);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Thread  $thread
    * @return \Illuminate\Http\Response
    */
    public function edit(Thread $thread)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Thread  $thread
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Channel  $channel
    * @param  \App\Thread  $thread
    * @return \Illuminate\Http\Response
    */
    public function destroy(Channel $channel, Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->delete();

        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect('/threads');
    }

    /**
    * Fetch threads matching the filter criteria.
    *
    * @param Channel $channel
    * @param ThreadsFilter $filters
    * @return mixed
    */

    protected function getThreads(Channel $channel, ThreadsFilter $filters)
    {
        $threads = Thread::with(['channel', 'creator'])->latest()->filter($filters);

        if ($channel->exists) {
            return $threads->where('channel_id', $channel->id)->get();
        }

        return $threads->get();
    }

}
