@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="h2">{{ $thread->title }}</div>
                    <small>posted by {{ $thread->creator->name }} on {{ $thread->created_at->format('l M jS Y') }}</small>
                </div>
                <div class="panel-body">{{ $thread->body }}</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>Some stats about this post:</h4>
                    <dl>
                    <dt>Reply count:</dt>
                    <dd>{{ $thread->replies_count }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        @foreach ($replies as $reply)
            @include('threads.reply')
        @endforeach

        <div class="col-md-8 col-md-offset-1 text-center">{{ $replies->links() }}</div>

        <div class="col-md-8 col-md-offset-1">
        @if (auth()->check())
            <form action="{{ $thread->path() . '/replies' }}" method="POST" class="form">
            {{ csrf_field() }}
                <div class="form-group">
                    <textarea
                        name="body" id="body"
                        class="form-control"
                        rows="5"
                        placeholder="Have something to say?">
                    </textarea>
                </div>
                <button class="btn btn-default" type="submit">Post</button>
            </form>
            @else
            <p>Please <a href="{{ route('login') }}">sign in</a> to add a reply.</p>
        @endif
        </div>
    </div>
</div>
@endsection
