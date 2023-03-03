@extends('layout')

@section('mock')
    <div class="mock-holder">
        @foreach($mockLists as $mock)
            <div class="container-mock">
                <div class="line"></div>
                <div class="each-mock">
                    <div class="hero">
                        <h3>{{$mock->title}}</h3>
                        <p class="msg">Please do not do any kind of misconducts while attempting.</p>
                        <p class="msg">If you are found doing any kind of misconduct you will be severly punished.</p>
                        <p class="msg">May also be terminated in severe case. Do understand and write the answers in your own view.</p>
                        <p class="start">Start date: {{$mock->start_date}}</p>
                        <p class="end">End date: {{$mock->end_date}}</p>
                    </div>
                    <div class="redir">
                        <a href="/mock/{{$mock->id}}">Take exam</a>
                    </div>
                </div>
                <div class="line"></div>
            </div>
        @endforeach
    </div>
@endsection