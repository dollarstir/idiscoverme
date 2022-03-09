<?php

use Illuminate\Database\Seeder;
use App\PermissionType;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermissionType::create(["name"=>"Roles"]);
        PermissionType::create(["name"=>"Staffs"]);
        PermissionType::create(["name"=>"Clients"]);
        PermissionType::create(["name"=>"Members"]);
        PermissionType::create(["name"=>"Institutions"]);
        PermissionType::create(["name"=>"Personalities"]);
        PermissionType::create(["name"=>"Questions"]);


        //permissions
        Permission::create(["name"=>"Add Role","permission_type_id"=>1]);
        Permission::create(["name"=>"Edit Role","permission_type_id"=>1]);
        Permission::create(["name"=>"Read Role","permission_type_id"=>1]);
        Permission::create(["name"=>"Delete Role","permission_type_id"=>1]);
        Permission::create(["name"=>"Assign Permission","permission_type_id"=>1]);
        Permission::create(["name"=>"Assign Role","permission_type_id"=>1]);

        
        Permission::create(["name"=>"Add Staff","permission_type_id"=>2]);
        Permission::create(["name"=>"Edit Staff","permission_type_id"=>2]);
        Permission::create(["name"=>"Read Staff","permission_type_id"=>2]);
        Permission::create(["name"=>"Delete Staff","permission_type_id"=>2]);

        Permission::create(["name"=>"Add Client","permission_type_id"=>3]);
        Permission::create(["name"=>"Edit Client","permission_type_id"=>3]);
        Permission::create(["name"=>"Read Client","permission_type_id"=>3]);
        Permission::create(["name"=>"Delete Client","permission_type_id"=>3]);

        
        Permission::create(["name"=>"Add Member","permission_type_id"=>4]);
        Permission::create(["name"=>"Edit Member","permission_type_id"=>4]);
        Permission::create(["name"=>"Read Member","permission_type_id"=>4]);
        Permission::create(["name"=>"Delete Member","permission_type_id"=>4]);
        Permission::create(["name"=>"Assign Member Institution ","permission_type_id"=>4]);
        Permission::create(["name"=>"Add Member Report ","permission_type_id"=>4]);

        Permission::create(["name"=>"Add Institution","permission_type_id"=>5]);
        Permission::create(["name"=>"Edit Institution","permission_type_id"=>5]);
        Permission::create(["name"=>"Read Institution","permission_type_id"=>5]);
        Permission::create(["name"=>"Delete Institution","permission_type_id"=>5]);
        Permission::create(["name"=>"Assign Client Institution ","permission_type_id"=>5]);

        Permission::create(["name"=>"Add Personalities","permission_type_id"=>6]);
        Permission::create(["name"=>"Edit Personalities","permission_type_id"=>6]);
        Permission::create(["name"=>"Read Personalities","permission_type_id"=>6]);
        Permission::create(["name"=>"Delete Personalities","permission_type_id"=>6]);
        Permission::create(["name"=>"Add Personality Course","permission_type_id"=>6]);
        Permission::create(["name"=>"Read Personality Course","permission_type_id"=>6]);
        Permission::create(["name"=>"Edit Personality Course","permission_type_id"=>6]);
        Permission::create(["name"=>"Delete Personality Course","permission_type_id"=>6]);
        Permission::create(["name"=>"Add Career Path","permission_type_id"=>6]);
        Permission::create(["name"=>"Read Career Path","permission_type_id"=>6]);
        Permission::create(["name"=>"Edit Career Path","permission_type_id"=>6]);
        Permission::create(["name"=>"Delete Career Path","permission_type_id"=>6]);
        Permission::create(["name"=>"Add Related Career","permission_type_id"=>6]);
        Permission::create(["name"=>"Read Related Career","permission_type_id"=>6]);
        Permission::create(["name"=>"Edit Related Career","permission_type_id"=>6]);
        Permission::create(["name"=>"Delete Related Career","permission_type_id"=>6]);
        

        Permission::create(["name"=>"Add Setup Question","permission_type_id"=>7]);
        Permission::create(["name"=>"Edit Setup Question","permission_type_id"=>7]);
        Permission::create(["name"=>"Read Setup Question","permission_type_id"=>7]);
        Permission::create(["name"=>"Delete Setup Question","permission_type_id"=>7]);
        Permission::create(["name"=>"Add Question","permission_type_id"=>7]);
        Permission::create(["name"=>"Edit Question","permission_type_id"=>7]);
        Permission::create(["name"=>"Read Question","permission_type_id"=>7]);
        Permission::create(["name"=>"Delete Question","permission_type_id"=>7]);

    }
}
