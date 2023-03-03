<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserScore extends Model
{
    use HasFactory;

    public function mock(){
        return $this->belongsTo(Mock::class);
    }

    public function user(){
        return $this->belongsTo(Mock::class);
    }
}
