<form action="/create/question/written" method="POST">
    @csrf
    <label>Question</label>
    <input type="text" id="" name="question"/>
    <label>Subject</label>
    <select name="subject_id">
        <option value="" disabled selected>Select a subject</option>
        @foreach($subjectList as $subject)
        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
        @endforeach
    </select>
    <label>Difficulty Level</label>
    <select name="difficulty">
        <option value="" disabled selected>Select a difficulty level</option>
        <option value="HARD">HARD</option>
        <option value="NORMAL">NORMAL</option>
        <option value="EASY">EASY</option>
    </select>
    <button>Craete Question.</button>
</form>