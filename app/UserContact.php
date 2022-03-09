<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserContact extends Model
{
    protected $fillable = ['user_id','phoneNumber'];

    public function user(){
        return $this ->belongsTo(User::class);
    }
}
