@extends('layout')

@section('mockeach')

<div class="wrap-mock">
    <form action="/mock/result" method="POST">
        @csrf
        @foreach($formattedArray as $item)
            <div>
                <h3 class="question">{{$item->question}}</h3>
                <input type="hidden" value={{$item->question_id}} name="question[]"/>
                <input type="hidden" name="mock_id" value="{{ $item->mockId }}" />
                <div class="ans-wrap">
                    @if($item->questionType === 'WRITTEN')
                        <div>
                            <textarea placeholder="type your answer here" name="answerWritten[{{$item->question_id}}]"></textarea>
                        </div>  
                    @endif
                    @if($item->questionType === "" || $item->questionType === "MOCK")
                        @foreach($item->answers as $answer) 
                            <div class="radiobtn">
                                <input type="radio" id="newst" name="answer[{{$item->question_id}}]" value={{$answer->id}} />
                                <label for="newst">{{$answer->answer}}</label>
                            </div>
                        @endforeach
                    @endif    
                </div>
                <div class="lines"></div>
            </div>
        @endforeach
        <div class="btn-holder">
            <button class="submitbtn">Check ans</button>
        </div>
    </form>
</div>
@endsection
