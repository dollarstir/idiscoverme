<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalityCourseRelated extends Model
{
    protected $fillable = ["personality_id","personality_course_id"];

    public function personalitycourse(){
        return $this ->belongsTo(PersonalityCourse::class);
    }

    public function personality(){
        return $this ->belongsTo(Personality::class);
    }
}
