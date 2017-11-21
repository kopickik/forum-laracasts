@component ('profiles.activities.activity')
  @slot('heading')
    {{ $profileUser->name }} replied to
    <a href="{{ $activity->subject->thread->path() }}">
      {{ $activity->subject->thread->path()}}
    </a> <span class="mla">{{ $activity->created_at->diffForHumans() }}</span>
  @endslot
  @slot('body')
    {{ $activity->subject->body }}
  @endslot
@endcomponent