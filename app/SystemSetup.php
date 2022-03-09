<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemSetup extends Model
{
    protected $fillable = ["id","software_name","software_short_name","organization_logo","organization_name","homepage_logo","header_logo","favicon","color","organization_location","organization_gps_address","organization_pobox"];
}
