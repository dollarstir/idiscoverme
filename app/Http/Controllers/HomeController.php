<?php

namespace App\Http\Controllers;
use App\User;
use App\Title;
use App\UserContact;
use App\UserEmailAddress;
use App\SystemSetup;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

class HomeController extends ValidationRequest
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(User::count())
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $setup = SystemSetup::take(1)->get()->first();
        return view('home',compact('setup'));
    }

    public function create(){
        $titles = Title::all();$staffrecord=true;
        $setup = SystemSetup::take(1)->get()->first();
        $admin = false;
        return view('staff.create',compact('titles','staffrecord','setup','admin'));
    }

    public function store(){
        $staff = User::create($this ->basic_information());
        if($staff->count()){
           $this ->user_contacts($staff->id);
           $this ->user_email_addresses($staff->id);
        }
        if(!empty(request()->is_admin)){
            if(!Role::count()){
                $role = Role::create(["name"=>"Administrator"]);
                $role->syncPermissions(["1","2","3","4","5","6","7"]);
                $staff->syncRoles($role);
            }
        }
        return response()->json(["success"=>true,"message"=>"Successfully Registered ".request()->firstname." ".request()->lastname,'sid'=>$staff->id]);
    }
    private function basic_information(){
        $staff_id = $this ->reg_user_id();
        return array('firstName' => filter_var(trim(request()->firstname),FILTER_SANITIZE_STRING),
                      'middleName' => filter_var(trim(request()->midllename),FILTER_SANITIZE_STRING),
                      'lastName' => trim(filter_var(request()->lastname),FILTER_SANITIZE_STRING),
                      'id'=>$staff_id,
                      'password'=>Hash::make($staff_id),
                      'title_id'=>request()->title,
                      'gender' => preg_replace("#[^0-9]#","",request()->gender),
                );
    }
    private function user_email_addresses($staff_id){
        foreach(request()->email as $email){
            if(!UserEmailAddress::where('address',$email)->get()->count())
            UserEmailAddress::create(["user_id"=>$staff_id,"address"=>trim($email)]);
        }
    }
    private function user_contacts($staff_id){
        foreach(request()->phone as $phone){
            if(!UserContact::where('phoneNumber',$phone)->get()->count())
                UserContact::create(["user_id"=>$staff_id,"phoneNumber"=>trim($phone)]);
        }
    }
    public function staffs(){
        $users = User::all();$staffrecord=true;$setup = SystemSetup::take(1)->get()->first();
        return view('staff.index',compact('users','staffrecord','setup'));
    }

    public function staff_lists(){
        $staff = User::all();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$staff);
    }
    public function roles(User $staff){
        $roles = Role::all();$staffrecord=true;$setup = SystemSetup::take(1)->get()->first();
        return view('staff.roles',compact('staff','roles','staffrecord','setup'));
    }

    public function assign_roles(User $staff){
        $staff->syncRoles(request()->role);
        return response()->json(["success"=>true,"message"=>"Successfully assigned role to ".$staff->firstName]);
    }

    public function show(User $staff){
        $staffprofilerecords = true;$setup = SystemSetup::take(1)->get()->first();
        return view('staff.profile',compact('staff','staffprofilerecords','setup'));
    }

    public function profile(){
        $user = User::where("id",Auth::user()->id)->get();
        $setup = SystemSetup::take(1)->get()->first();
        $staffprofilerecords=true;
        if($user->count()){
            $staff = $user->first();
            return view('staff.profile',compact('staff','staffprofilerecords','setup'));
        }else{
            return redirect("error/account/notfound");
        }
    }

    public function edit(User $staff){
        $staff_full_name = trim(filter_var(request()->flname,FILTER_SANITIZE_STRING));
        $staff->update(["firstName"=>$this ->filter_name($staff_full_name)['firstName'],"middleName"=>$this ->filter_name($staff_full_name)['middleName'],"lastName"=>$this ->filter_name($staff_full_name)['lastName']]);
        return response()->json(["success"=>true,"message"=>"Successfully updated profile"]);
    }
    private function filter_name($staff_full_name){
        $info=[];
        $staff_full_name= explode(" ",$staff_full_name);
        if(isset($staff_full_name[0])){
            $info['firstName']=trim($staff_full_name[0]);
        }
        if(isset($staff_full_name[1])){
            $info['middleName']=trim($staff_full_name[1]);
        }
        if(isset($staff_full_name[2])){
            $info['lastName']=trim($staff_full_name[2]);
        }
        return $info;
    }

    public function editphone(UserContact $phone){
        $phoneNumber = trim(preg_replace("#[^0-9]#","",request()->phone));
        if(UserContact::where("phoneNumber",$phoneNumber)->get()->count())
            return response()->json(["success"=>false,"message"=>"You cannot this phone number $phoneNumber"]);

        $phone->update(["phoneNumber"=>$phoneNumber]);
        return response()->json(["success"=>true,"message"=>"Successully updated phone number!"]);
    }

    public function deletephone(UserContact $phone){
        $phoneNumber = trim(preg_replace("#[^0-9]#","",request()->phone));
        $phone->delete();
        return response()->json(["success"=>true,"message"=>"Successully deleted $phoneNumber!"]);
    }

    public function addPhoneNumber(User $staff){
        $phoneNumber = preg_replace("#[^0-9]#","",request()->phone);
        if(empty($phoneNumber))
            return response()->json(["success"=>false,"message"=>"Please, valid phone number!"]);
        
        if(strlen($phoneNumber) < 10)
            return response()->json(["success"=>false,"message"=>"Please, valid phone number!"]);

        if(UserContact::where("phoneNumber",$phoneNumber)->get()->count())
            return response()->json(["success"=>false,"message"=>"You cannot this phone number $phoneNumber"]);
         
        $id = UserContact::create(["user_id"=>$staff->id,"phoneNumber"=>trim($phoneNumber)]); 
        return response()->json(["success"=>true,"message"=>"Successfully added new phone number","info"=>$id->id]);
        
    }
    public function addEmailAddress(User $staff){
        $email = filter_var(request()->mail,FILTER_SANITIZE_STRING);
        if(empty($email))
            return response()->json(["success"=>false,"message"=>"Please, valid email address!"]);

        if(UserEmailAddress::where("address",$email)->get()->count())
            return response()->json(["success"=>false,"message"=>"You cannot use $email, you different address!"]);
        
        $id = UserEmailAddress::create(["user_id"=>$staff->id,"address"=>$email]);
            return response()->json(["success"=>true,"message"=>"Successfully added new email address","info"=>$id->id]);

    }

    public function deletemail(UserEmailAddress $mail){
        $mail->delete();
        return response()->json(["success"=>true,"message"=>"Successfully deleted email address!"]);
    }

    public function resetpassword(){
        $setup = SystemSetup::take(1)->get()->first();
        return view('staff.resetpassword.reset',compact('setup'));
    }

    public function update_account_password(){
        $oldpassword = request()->oldpass;
        $newpassword = request()->newpass;
        $confirm_password = request()->confirmpass;

        if(empty($oldpassword) || empty($newpassword) || empty($confirm_password))
            return response()->json(["success"=>false,"message"=>"Please, all fields required!"]);

        if(strlen($newpassword < 6))
            return response()->json(["success"=>false,"message"=>"Your new password must consist of at least 2 characters"]);
        
        if($newpassword != $confirm_password)
            return response()->json(["success"=>false,"message"=>"Your new password must be the same as confirm password!"]);

        if(!Hash::check($oldpassword,Auth::user()->password))
            return response()->json(["success"=>false,"message"=>"Your old password is incorrect!"]);

        if($oldpassword == $newpassword)
            return response()->json(["success"=>false,"message"=>"You cannot old password your new password!"]);

        $password = Hash::make($newpassword);
        User::where("id",Auth::user()->id)->update(["password"=>$password]);
        return response()->json(["success"=>true,"message"=>"Successfully changed your password!"]);

    }

    public function setup_administrator(){
        $titles = Title::all();$staffrecord=true;
        $admin=true;
        $setup = SystemSetup::take(1)->get()->first();
        return view('staff.create',compact('titles','staffrecord','setup','admin'));
    }
}
