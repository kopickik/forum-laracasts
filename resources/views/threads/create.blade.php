@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="h2">Create new Thread</div>
          </div>
          <div class="panel-body">
            <form class="form" action="/threads" method="POST">
              {{ csrf_field() }}
              
              <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="">
              </div>
              <div class="form-group">
                <label for="body">Body:</label>
                <textarea class="form-control" rows="8" cols="" name="body"></textarea>
              </div>
              <div class="form-group">
                <label for="channelSelection">Choose a channel:</label>
                <select name="channel_id" id="channel_id" class="form-control" required>
                <option value="">Pick one..</option>
                @foreach ($channels as $channel)
                  <option 
                    value="{{ $channel->id }}"
                    {{old('channel_id') == $channel->id ? 'selected' : '' }}
                    >{{$channel->name }}
                  </option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <button class="btn btn-primary pull-right" type="submit">Post</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
