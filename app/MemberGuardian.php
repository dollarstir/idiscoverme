<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberGuardian extends Model
{
    protected $fillable = ['guardian_id','member_member_id'];

    public function members(){
        return $this ->belongsTo(Member::class);
    }
    public function guardian(){
        return $this ->belongsTo(Guardian::class);
    }
}
