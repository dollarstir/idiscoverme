<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $fillable = ['id','fullName','type'];

    public function member_guardian(){
        return $this ->hasMany(MemberGuardian::class);
    }

    public function getTypeAttribute($attribute){
        return [
            0=>'Parent (Mother)',
            1=>'Parent (Father)',
            2=>'Guardian'
        ][(int)$attribute];
    }

    public function phone_numbers(){
        return $this ->hasMany(GuardianContact::class);
    }
}
