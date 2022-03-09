<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEmailAddress extends Model
{
    protected $fillable = ['user_id','address'];

    public function user(){
        return $this ->belongsTo(User::class);
    }
}
