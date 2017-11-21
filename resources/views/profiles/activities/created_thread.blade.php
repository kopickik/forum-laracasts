@component('profiles.activities.activity')
  @slot('heading')
    {{ $profileUser->name }} published&nbsp;
    <a href="{{ $activity->subject->path() }}">
      {{ $activity->subject->title }}
    </a> <span class="mla">{{ $activity->created_at->diffForHumans() }}</span>
  @endslot
  @slot('body')
    {{ $activity->subject->body }}
  @endslot
@endcomponent