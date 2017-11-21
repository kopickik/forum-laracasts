@component('profiles.activities.activity')
  @slot('heading')
    {{ $profileUser->name }} favorited something: 
    {{ $activity }}
  @endslot
  @slot('body')
    {{ $activity->subject->body }}
  @endslot
@endcomponent
