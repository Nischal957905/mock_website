@extends('layout')

@section('mocklist')

<div>
    <a href="/create/mock/subject">Create new Mock</a>
</div>

@foreach($mockData as $mock)
    <p>{{$mock['title']}}</p>
    @foreach($mock['questions'] as $question)
            <li>{{ $question->question }}</li>
    @endforeach
@endforeach

@endsection