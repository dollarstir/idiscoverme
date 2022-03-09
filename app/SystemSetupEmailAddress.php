<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemSetupEmailAddress extends Model
{
    protected $fillable=["system_setup_id","email_address"];
}
