<form action="/create/mock/new" method="POST">
    @csrf
    <label>Name for the mock Exam</label>
    <input type="text" id="" name="name"/>
    <br>
    <label>Choose a start date.</label>
    <input type="date" id="date" name="start_date">
    <br>
    <label>Choose a end date</label>
    <input type="date" id="date" name="end_date">
    @foreach ($questions as $question)
        <div>
            <input type="checkbox" id="{{ $question->id }}" name="questions[]" value="{{ $question->id }}">
            <label for="{{ $question->id }}">{{ $question->question }}</label><br>
            <p>{{$question->difficulty_level}}</p>
        </div>    
    @endforeach
    <button>Create a mock</button>
</form>
