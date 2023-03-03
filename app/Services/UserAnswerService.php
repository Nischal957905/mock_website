<?php

namespace App\Services;

use App\Models\UserAnswer;

class UserAnswerService{

    public function create($user_id,$mock_id,$question_id,$answer){
        $userAnswer = UserAnswer::updateOrCreate(
            ['user_id' => $user_id, 'mock_id' => $mock_id, 'question_id' => $question_id],
            ['answer' => $answer]
        );
        return $userAnswer;
    }
}