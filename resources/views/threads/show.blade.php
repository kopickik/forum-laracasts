@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $thread->title }}</div>
                <div class="panel-body">{{ $thread->body }}</div>
            </div>
        </div>
        @foreach ($thread->replies as $reply)
            @include('threads.reply')
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        @if (auth()->check())
            <form action="{{ $thread->path() . '/replies' }}" method="POST">
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
