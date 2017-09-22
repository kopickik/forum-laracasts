@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Forum threads</div>
          <div class="panel-body">
            @foreach($threads as $thread)
            <article>
              <h4><a href="{{ route('threads.show', $thread) }}">{{$thread->title}}</a>
              <small>posted by {{$thread->creator->name}} {{$thread->created_at->diffForHumans()}}</small>
              </h4>
              <p>{{$thread->body}}</p>
            </article>
            <hr>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection