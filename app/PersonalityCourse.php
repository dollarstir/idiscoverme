<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalityCourse extends Model
{
    protected $fillable = ["personality_id"];

    public function personality_course_relate(){
        return $this ->hasMany(PersonalityCourseRelated::class);
    }

    public function personality(){
        return $this ->belongsTo(Personality::class);
    }
}
