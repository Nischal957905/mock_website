<?php

namespace App\Services;

use App\Models\Question;

class QuestionService{

    public function create($question,$subject_id,$difficulty){
        $newQuestion = new Question;
        $newQuestion->question = $question;
        $newQuestion->subject_id = $subject_id;
        $newQuestion->difficulty_level = $difficulty;
        $newQuestion->type = "MOCK";
        $newQuestion->save();
        return $newQuestion;
    }

    public function createWritten($question,$subject_id,$difficulty){
        $newQuestion = new Question;
        $newQuestion->question = $question;
        $newQuestion->subject_id = $subject_id;
        $newQuestion->difficulty_level = $difficulty;
        $newQuestion->type = "WRITTEN";
        $newQuestion->save();
        return $newQuestion;
    }

    public function findFrom($subjects){
        $subjectIds = array_map('intval', $subjects);
        $newQuestion = Question::select('id', 'question', 'difficulty_level')
        ->whereIn('subject_id', $subjectIds)
        ->get();
        return $newQuestion;
    }

    public function getAnswers($id){
        $answers = Question::findorFail($id);
        $questionAnswers = $answers->answer()->select('id','answer')->orderByRaw('RAND()')->get();
        return $questionAnswers;
    }

    public function getTitle($id){
        $questionId = Question::select('question','type')->findOrFail($id);
        return $questionId;
    }
    public function correctAnswer($answer_id,$id){
        $correctness = Question::findorFail($id);
        $checkResult = $correctness->answer()
            ->where('question_id',$id)
            ->where('id',$answer_id)
            ->value('is_correct');
        
        return $checkResult;
    }

}