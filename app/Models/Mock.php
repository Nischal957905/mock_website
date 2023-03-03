<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mock extends Model
{
    use HasFactory;

    protected $fillable = ['title','start_date','end_date'];

    public function questions(){
        return $this->belongsToMany(Question::class, 'mock_questions');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'user_mocks')->withPivot(['score', 'score_status']);
    }

    public function userAnswer(){
        return $this->hasMany(UserAnswer::class);
    }
}
