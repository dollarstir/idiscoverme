<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ["id","user_id","name","Description","start_at","end_at","privacy"];

    public function getPrivacyAttribute($attribute){
        return [
            0=>'Private',
            1=>'Public',
            3=>'Custom'
        ][$attribute];
    }
}
