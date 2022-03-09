<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CareerPathScore extends Model
{
    protected $fillable = ["question_setup_score_id","career_path_id","score"];

    public function career_path(){
        return $this ->belongsTo(CareerPath::class);
    }
}
