<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuardianContact extends Model
{
    protected $fillable = ['phoneNumber','guardian_id'];

    public function guardian(){
        return $this ->belongsTo(Guardian::class);
    }
}
