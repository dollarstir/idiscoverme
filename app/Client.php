<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable =["id","firstName","middleName","lastName","gender","password","location"];

    public function getGenderAttribute($attribute){
        return [
            0=>'Female',
            1=>'Male',
            3=>'Rather not to say'
        ][$attribute];
    }

}
