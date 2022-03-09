<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstitutionContact extends Model
{
    protected $fillable = ['phoneNumber','institution_institution_id'];

    public function institution(){
        return $this ->belongsTo(Institution::class);
    }
}
