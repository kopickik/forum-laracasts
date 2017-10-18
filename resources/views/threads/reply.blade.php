<div class="col-md-8 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ $reply->created_at->diffForHumans() }},
            <a href="#">{{$reply->owner->name}}</a> said
            <div class="pull-right">
                <form method="POST" action="/replies/{{$reply->id}}/favorites">
                    {{ csrf_field() }}
                    <button
                        type="submit"
                        class="btn btn-default" {{$reply->isFavorited() ? 'disabled' : ''}}>
                        {{ $reply->favorites_count }}&nbsp;
                        {{ str_plural('favorite', $reply->favorites_count)}}
                    </button>
                </form>
            </div>
        </div>
        <div class="panel-body">{{ $reply->body }}</div>
    </div>
</div>