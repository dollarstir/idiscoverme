<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberInstitution extends Model
{
    protected $fillable = ['institution_institution_id','member_member_id'];

    public function institution(){
        return $this->belongsTo(Institution::class);
    }
}
