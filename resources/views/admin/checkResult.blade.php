@extends('layout')

@section('check')

@foreach($userAnswerData as $userId => $ans )
    @foreach($ans as $mockId => $mock)
            <h2>{{$mock['mock_title']}}</h2>
            <strong>Submitted by: {{$mock['username']}}</strong>
        <form action="/check/ans" method="POST">    
            @csrf
        @foreach($mock['questions'] as $questions)
            <p>{{$questions['question']}}</p>
            <p>{{$questions['answer']}}</p>
            <p>{{$questions['id']}}</p>
            <input type="hidden" name="ids[]" value="{{$questions['id']}}" />
            <label>Score</label>
            <input type="number" name="score[]"/>
        @endforeach
            <input type="hidden" name="mockId" value="{{$mockId}}"/>
            <input type="hidden" name="userId" value="{{$userId}}"/>
            <button>Score</button>
        </form>
    @endforeach
@endforeach

@endsection