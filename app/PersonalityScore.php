<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalityScore extends Model
{
    protected $fillable = ["question_setup_score_id","personality_id","score"];

    public function personality(){
        return $this ->belongsTo(Personality::class);
    }
}
