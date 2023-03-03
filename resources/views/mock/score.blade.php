@extends('layout')

@section('score')

<div class="score-wrap">
    @if(session('success'))
            <div class="alert stls">
                {{ session('success') }}
            </div>
    @endif

    <a class="goback" href="/home">Go back</a>
</div>
@endsection