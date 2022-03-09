<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ["question_setup_id","career_path_id","question","question_number"];


    public function getQuestionAttribute($attribute){
        return stripslashes($attribute);
    }

    public function getCareerPathIdAttribute($attribute){
        $career_path = CareerPath::where("id",$attribute)->get();
        if($career_path->count())
            return $career_path->first()->name;
        else
            return "";
    }

    public function question_setup(){
        return $this ->belongsTo(QuestionSetup::class);
    }

    public function career_path(){
        return $this ->belongsTo(CareerPath::class);
    }

    public function question_scores(){
        return $this ->hasMany(QuestionScore::class);
    }
    
    public function get_score($question_id,$question_setup_score){
        $question_score = QuestionScore::where(["question_id"=>$question_id,"question_setup_score_id"=>$question_setup_score])->get();
        if($question_score->count()){
            return $question_score->first()->score;
        }
        return 0;
    }
}
