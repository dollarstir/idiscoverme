<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstitutionEmailAddress extends Model
{
    protected $fillable = ['address','institution_institution_id'];
    public function institution(){
        return $this ->belongsTo(Institution::class);
    }
}
