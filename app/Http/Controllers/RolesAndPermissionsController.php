<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PermissionType;
use App\SystemSetup;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsController extends ValidationRequest
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $roles = Role::all();$rolerecords=true;
        $setup = SystemSetup::take(1)->get()->first();
        return view('roles.index',compact('roles','rolerecords','setup'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rolerecords=true;
        $setup = SystemSetup::take(1)->get()->first();
        return view('roles.create',compact('rolerecords','setup'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role_name = trim(filter_var(request()->role,FILTER_SANITIZE_STRING));
        if(Role::where("name",$role_name)->get()->count()){
            return response()->json(["success"=>false,"message"=>"$role_name already exists!"]);
        }
        $role = Role::create(["name"=>$role_name]);
        return response()->json(["success"=>true,"message"=>"Successfully added $role_name!","rid"=>$role->id]);
    }

    public function permissions(Role $role){
        $permission_type = PermissionType::all();$rolerecords=true;
        $setup = SystemSetup::take(1)->get()->first();
        return view('roles.permissions',compact('permission_type','role','rolerecords','setup'));
    }
    public function rolelist(){
        $roles = Role::all();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$roles);
  
    }
    private function roles(){
        $data=[];
        $roles = Role::all();
        foreach($roles as $role){
            $data[]=array("name"=>$role->name,"created_at"=>$role->created_at);
        }
        return $data;
    }
    public function assign_role_permissions(Role $role){
        $permissions = request()->permissions;
        $role->syncPermissions($permissions);
        return response()->json(["success"=>true,"message"=>"Successfully assigned permissions to $role->name"]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $role_id = trim(request()->roleid);
        $rolename = trim(filter_var(request()->rolename,FILTER_SANITIZE_STRING));
        $role = Role::where("id",$role_id)->get();
        if(!$role->count())
            return response()->json(["success"=>false,"message"=>"Role not found!"]);
        else{
            $searchRoleName = Role::where("name",$rolename)->get();
            if($searchRoleName->count())
            return response()->json(["success"=>false,"message"=>"$rolename already exists!"]);
        
            $role->first()->update(["name"=>$rolename]);
        }
        return response()->json(["success"=>true,"message"=>"Successfully updated role!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $role_id = trim(request()->roleid);
        $role = Role::where("id",$role_id)->get();
        if(!$role->count())
            return response()->json(["success"=>false,"message"=>"Role not found!"]);
        else
            $role->first()->delete();
        return response()->json(["success"=>true,"message"=>"Successfully deleted role"]);
    }
}
