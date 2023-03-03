@extends('layout')

@section('createQuestion')
<div class="student-wrap">
    <div class="form-wrap">
        <div class="header-form">Create new Question</div>
        <form action="/createQuestion" method="post" class="klop">
            @csrf
            <div class="form-area">
                <label>Question</label>
                <input type="text" id="" name="question"/>
            </div>
            <div class="form-area">
                <label>Subject</label>
                <select name="subject_id">
                    <option value="" disabled selected>Select a subject</option>
                    @foreach($subjectList as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-area">
                <label>Difficulty Level</label>
                <select name="difficulty">
                    <option value="" disabled selected>Select a difficulty level</option>
                        <option value="HARD">HARD</option>
                        <option value="NORMAL">NORMAL</option>
                        <option value="EASY">EASY</option>
                </select>
            </div>
            <div class="form-area">
                <label>Correct answer</label>
                <input type="text" id="" name="correct_answer"/>
            </div>
            <div class="form-area">
                <label>Option one</label>
                <input type="text" id="" name="option_one"/>
            </div>
            <div class="form-area">
                <label>Option two</label>
                <input type="text" id="" name="option_two"/>
            </div>
            <div class="form-area">
                <label>Option three</label>
                <input type="text" id="" name="option_three"/>
            </div>
            <div class="form-area">
                <button>Create question</button>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection


