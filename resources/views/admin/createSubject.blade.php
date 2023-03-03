@extends('layout')

@section('createSubject')
<div class="student-wrap">
    <div class="form-wrap">
        <div class="header-form">Create new Subject</div>
        <form action="/create" method="POST">
            @csrf
            <div class="form-area">
                <label for="">Subject name</label>
                <input type="text" id="" name="name"/>
            </div>
            <div class="form-area neutral">
                <button type="submit">Create</button>
            </div>
        </form>
    </div>
</div>

@endsection