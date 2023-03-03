@extends('layout')

@section('selectSubject')

<div class="student-wrap">
    <div class="form-wrap">
        <div class="header-form">Select Subjects you want to add to the mock.</div>
<form action="/create/mock/question" method="POST">
    @csrf
    @foreach ($subjectList as $subject)
        <input type="checkbox" id="{{ $subject->id }}" name="subjects[]" value="{{ $subject->id }}">
        <label for="{{ $subject->id }}">{{ $subject->name }}</label><br>
    @endforeach
    <div class="form-area">
        <button>Confirm Subjects</button>
    </div>
</form>
</div>
</div>

@endsection