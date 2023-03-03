@extends('layout')

@section('profile')

<form action="/edit/profile/{{$user->id}}" method="POST">
    @csrf
    <div>
        <label>First name</label>
        <input value="{{$user->first_name}}" name="first_name" />
    </div>
    <div>
        <label>Last name</label>
        <input value="{{$user->last_name}}" name="last_name" />
    </div>
    <button>Save changes</button>
</form>

@foreach($userScores as $user)
    <h3>{{$user->title}}</h3>
    <p>Scored: {{$user->score}}</p>
    <p>Score status: {{$user->score_status}}</p>
@endforeach

@endsection