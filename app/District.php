<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function region(){
        return $this->belongsTo(Region::class);
    }
    
    public function institution(){
        return $this ->hasmany(Institution::class);
    }
}
