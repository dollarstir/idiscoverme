<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionSetupScore extends Model
{
    protected $fillable = ["member_member_id","question_setup_id","institution_institution_id","age"];

    public function institution(){
        return $this ->belongsTo(Institution::class);
    }

    public function question_setup(){
        return $this->belongsTo(QuestionSetup::class);
    }
    public function question_score(){
        return $this->hasMany(QuestionScore::class);
    }

    public function get_total_scores($question_setup_id,$score_type){
        return QuestionScore::where(["question_setup_score_id"=>$question_setup_id,"score"=>$score_type])->get()->count();
    }
}
