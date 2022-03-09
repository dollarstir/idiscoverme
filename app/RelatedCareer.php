<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelatedCareer extends Model
{
    protected $fillable = ["career_path_id","name"];

    public function career_path(){
        return $this ->belongsTo(CareerPath::class);
    }
}
