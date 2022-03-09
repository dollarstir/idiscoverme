<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionScore extends Model
{
    protected $fillable = ["question_setup_score_id","question_id","score"];

    public function question(){
        return $this ->belongsTo(Question::class);
    }

    public function question_setup_scores(){
        return $this ->belongsTo(QuestionSetupScore::class);
    }
    
}
