<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['subject_id','question','difficulty_level','type'];

    public function answer(){
        return $this->hasMany(Answer::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function mocks(){
        return $this->belongsToMany(Mock::class, 'mock_questions');
    }

    public function userAnswer(){
        return $this->hasMany(UserAnswer::class);
    }
}

