@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="page-header">
            <img src="{{$profileUser->avatar}}" alt="{{$profileUser->avatar}}" class="img pull-left">
                <h1>
                    {{ $profileUser->name }}
                    <small>since {{ $profileUser->created_at->diffForHumans() }}</small>
                </h1>
            </div>
            @foreach ($threads as $thread)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{$thread->path()}}">
                        {{ $thread->title}}
                        </a>
                        <span class="pull-right">
                            {{$thread->created_at->diffForHumans()}}
                        </span>
                    </div>
                    <div class="panel-body">
                        {{$thread->body}}
                    </div>
                </div>
            @endforeach
        {{$threads->links()}}
        </div>
    </div>
</div>
@endsection