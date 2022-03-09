<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionSetup extends Model
{
    protected $fillable = ["id","name"];

    public function getNameAttribute($attribute){
        return stripslashes($attribute);
    }

    public function questions(){
        return $this ->hasMany(Question::class);
    }
    public function question_setup_score(){
        return $this ->hasMany(QuestionSetupScore::class);
    }
}
