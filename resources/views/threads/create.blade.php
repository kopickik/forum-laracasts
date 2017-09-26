@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <h2 class="panel-heading">Create new Thread</h2>
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
              <button class="btn btn-primary pull-right" type="submit">Post</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
