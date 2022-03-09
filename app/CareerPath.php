<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CareerPath extends Model
{
    protected $fillable = ["name","id","personality_id","alternative_name"];

    public function personality(){
        return $this ->belongsTo(Personality::class);
    }
    public function related_careers(){
        return $this->hasMany(RelatedCareer::class);
    }
    public function questions(){
        return $this ->hasMany(Question::class);
    }

    public function career_path_scores(){
        return $this ->hasMany(CareerPathScore::class);
    }

    public function get_questions($career_path_id,$question_setup_id,$skip){
        return Question::where(["question_setup_id"=>$question_setup_id,"career_path_id"=>$career_path_id])->orderBy("question_number","asc")->skip($skip)->take(1)->get();
    }

    public function career_path_score($career_path_id,$question_setup_score){
        $career_path_score = CareerPathScore::where(["career_path_id"=>$career_path_id,"question_setup_score_id"=>$question_setup_score])->get();
        if($career_path_score->count())
            return $career_path_score->first()->score;
        else
            return "";
    }

    public function get_related_career($career_path_id,$skip){
       return RelatedCareer::where("career_path_id",$career_path_id)->orderBy("name","asc")->skip($skip)->take(1)->get();
    }
    
}
