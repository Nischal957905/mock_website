<?php

namespace App\Services;

use App\Models\Subject;

class SubjectService{

    public function create($name){
        $subject = new Subject;
        $subject->name = $name;
        $subject->save();
        return $subject;
    }

    public function list(){
        $subjects = Subject::select('id','name')->get();
        $isEmpty = true;

        if ($subjects->isEmpty()) {
            return 0;
        }
        return $subjects;
    }
}