<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TokenKey extends Model
{
    protected $fillable = ["member_member_id","institution_institution_id","token_key"];

    public function member(){
        return $this->belongsTo(Member::class);
    }
}
