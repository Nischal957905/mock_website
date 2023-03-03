<?php

namespace App\Services;

use App\Models\Answer;

class AnswerService{

    public function create($question_id,$answer,$status){
        $newAnswer = new Answer;
        $newAnswer->answer = $answer;
        $newAnswer->is_correct = $status;
        $newAnswer->question_id = $question_id;
        $newAnswer->save();
        return $newAnswer;
    }
}