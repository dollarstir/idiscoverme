<?php

namespace App;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class PermissionType extends Model
{
    public function permissions($permission_type_id){

        return Permission::where("permission_type_id",$permission_type_id)->get();
    }
}
