@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
      @foreach($threads as $thread)
        <div class="panel panel-default">
          <div class="panel-heading"><div class="pull-right">
                <small>{{$thread->replies_count}}
                {{str_plural('reply', $thread->replies_count)}}</small>
              </div>
              <h4 class="mb0"><a href="{{ url($thread->path()) }}">{{$thread->title}}</a>
              </h4>
              <small>posted by {{$thread->creator->name}} {{$thread->created_at->diffForHumans()}}</small>
          </div>
          <div class="panel-body">
            <article>
              <p>{{$thread->body}}</p>
            </article>
          </div>
        </div>
      @endforeach
      </div>
    </div>
  </div>
@endsection