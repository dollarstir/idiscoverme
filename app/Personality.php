<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personality extends Model
{
    protected $fillable = ["id","name","related_programme","success_message"];

    public function career_paths(){
        return $this ->hasMany(CareerPath::class);
    }
    
    public function personality_courses(){
        return $this ->hasMany(PersonalityCourse::class);
    }

    public function personality_course_relate(){
        return $this ->hasMany(PersonalityCourseRelated::class);
    }

    public function personality_scores(){
        return $this ->hasMany(PersonalityScore::class);
    }
    public function dorminant_personalities(){
        return $this ->hasMany(DorminantPersonality::class);
    }

    public function set_personality_score($personality_id,$question_setup_score_id){
        $personality_score = PersonalityScore::where(["question_setup_score_id"=>$question_setup_score_id,"personality_id"=>$personality_id])->get();
        if($personality_score->count() > 0){
            return $personality_score->first()->score;
        }
        return "";
    }
}
