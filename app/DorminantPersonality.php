<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DorminantPersonality extends Model
{
    protected $fillable = ["question_setup_score_id","personality_id","score","position"];

    public function personality(){
        return $this ->belongsTo(Personality::class);
    }

    public function totalCareers($personality_id){
        $data=[];
        $career_paths= CareerPath::where("personality_id",$personality_id)->get();
        foreach($career_paths as $career_path){
            $data[]= RelatedCareer::where("career_path_id",$career_path->id)->get()->count();
         }
        $data_size =rsort($data);
        return $data[0];
    }
}
