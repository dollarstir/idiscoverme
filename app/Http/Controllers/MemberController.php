<?php

namespace App\Http\Controllers;
use App\Title;
use App\Member;
use App\Guardian;
use App\GuardianContact;
use App\MemberGuardian;
use App\Institution;
use App\TokenKey;
use App\MemberInstitution;
use App\SystemSetup;
use App\Report;
use Illuminate\Http\Request;

class MemberController extends ValidationRequest
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $member_records=true;
        $setup = SystemSetup::take(1)->get()->first();
        return view('members.index',compact('member_records','setup'));
    }

    public function download_template(){
            //PDF file is stored under project/public/download/info.pdf

            $file= public_path("downloads/add_member_template.csv");
            $name = basename($file);
            $name="";
            $mime_content_type = mime_content_type($file);
            $headers = [
                'Content-type'        => 'text/csv',
                'Content-Disposition' => 'attachment; filename="download.csv"',
            ];

           // dd($headers);
            return response()->download($file,$name,$headers);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titles = Title::all();
        $setup = SystemSetup::take(1)->get()->first();
        return view('members.create',compact('titles','setup'));
    }

    public function create_instutition_member(Institution $institution){
        $titles = Title::all();
        $setup = SystemSetup::take(1)->get()->first();
        return view('members.create',compact('titles','institution','setup'));
    }
    public function list(){
        $members = Member::where("account_status","1")->get();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$members);
    }

    public function import(){
        $member_info = trim(request()->member_info);
        if(count($this ->get_member_info())<= 8){
            return response()->json(["success"=>false,"message"=>"Please, check the member list"]);
        }else{
           
            $member_id = $this->member_id($this ->get_member_info()[0],$this ->get_member_info()[1],$this ->get_member_info()[2]);
            $member=Member::create($this ->save_import_basic_info($member_id));

            if($this ->guardian_found($this ->get_guardian_contacts())->count())
                $guardian_id = $this ->guardian_found($this ->get_guardian_contacts())->first()->guardian_id;
            else
                $guardian_id = $this ->save_import_guardian();

            if(!MemberGuardian::where(["member_member_id"=>$member_id,"guardian_id"=>$guardian_id])->get()->count())
            MemberGuardian::create(["member_member_id"=>$member_id,"guardian_id"=>$guardian_id]);

            if(isset(request()->inid) && !empty(request()->inid)){
                if(!MemberInstitution::where(["institution_institution_id"=>request()->inid,"member_member_id"=>$member_id])->get()->count()){
                    MemberInstitution::create(["institution_institution_id"=>request()->inid,"member_member_id"=>$member_id]);
                }
            }
        }
    
        return response()->json(["success"=>true,"message"=>"Successfully registered ".$this ->get_member_info()[0]." ".$this ->get_member_info()[2]]);
    }
    private function save_import_guardian(){
        $guardian = Guardian::create([
            "id" =>$this->reg_user_id(),
            "fullName"=>trim(filter_var($this ->get_member_info()[6],FILTER_SANITIZE_STRING)),
            "type"=>trim($this ->get_member_info()[7])
        ]);

        foreach($this->get_guardian_contacts() as $phone){
            GuardianContact::create(["guardian_id"=>$guardian->id,"phoneNumber"=>trim($phone)]);
        }
        
        return $guardian->id;
    }
    private function get_guardian_contacts(){
        $data=[];
       $contacts = explode(",",$this ->get_member_info()[8]);
       foreach($contacts as $contact){
           if(strlen($contact) <10){
                $data[]="0".$contact;
           }else{
               $data[]=$contact;
           }
       }
       return $data;
    }
    private function save_import_basic_info($member_id){
        return array(
            "member_id"=>$member_id,
            "firstName"=>trim(filter_var($this ->get_member_info()[0],FILTER_SANITIZE_STRING)),
            "middleName"=>trim(filter_var($this ->get_member_info()[1],FILTER_SANITIZE_STRING)),
            "lastName"=>trim(filter_var($this ->get_member_info()[2],FILTER_SANITIZE_STRING)),
            "gender"=>trim($this ->get_member_info()[3]),
            "dateOfBirth"=>preg_replace("#[^0-9-]#","",$this ->get_member_info()[4])
        );
    }
    private function get_member_info(){
        return explode(",",request()->member_info);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $member_id = $this->member_id(trim(request()->firstname),trim(request()->midllename),trim(request()->lastname));
         
        $member=Member::create($this ->save_basic_information($member_id));
        if($this ->guardian_found(request()->phone)->count())
            $guardian_id = $this ->guardian_found(request()->phone)->first()->guardian_id;
        else
            $guardian_id= $this ->save_guardian();

        if(!MemberGuardian::where(["member_member_id"=>$member_id,"guardian_id"=>$guardian_id])->get()->count())
            MemberGuardian::create(["member_member_id"=>$member_id,"guardian_id"=>$guardian_id]);

        if(isset(request()->inid) && !empty(request()->inid)){
            if(!MemberInstitution::where(["institution_institution_id"=>trim(request()->inid),"member_member_id"=>$member_id])->get()->count()){
                MemberInstitution::create(["institution_institution_id"=>trim(request()->inid),"member_member_id"=>$member_id]);
            }
        }
        return response()->json(["success"=>true,"message"=>"Successfully Registered ".request()->firstname." ".request()->lastname,"mid"=>$member_id]);
    }
    private function save_guardian(){
        $guardian = Guardian::create([
            "id" =>$this->reg_user_id(),
            "fullName"=>trim(filter_var(request()->gpfullname,FILTER_SANITIZE_STRING)),
            "type"=>trim(request()->gptype)
        ]);
        
        foreach(request()->phone as $phone){
            GuardianContact::create(["guardian_id"=>$guardian->id,"phoneNumber"=>trim($phone)]);
        }
        return $guardian->id;
    }
    private function guardian_found($phone){
        return GuardianContact::whereIn("phoneNumber",$phone)->get();
    }
    private function save_basic_information($member_id){
        return array(
            "member_id"=>$member_id,
            "firstName"=>trim(filter_var(request()->firstname,FILTER_SANITIZE_STRING)),
            "middleName"=>trim(filter_var(request()->midllename,FILTER_SANITIZE_STRING)),
            "lastName"=>trim(filter_var(request()->lastname,FILTER_SANITIZE_STRING)),
            "gender"=>trim(request()->gender),
            "dateOfBirth"=>trim(request()->dateOfBirth)
        );
    }
    private function member_id($firstName,$middleName,$lastName){
        $first="";$second="";$third="";
        if(!empty($firstName))
        $first = substr($firstName,0,1);
        if(!empty($middleName)){
            $second = substr($middleName,0,1);
        }else{
            $second = substr($lastName,strlen($lastName)-1,1);
        }
        if(!empty($lastName))
        $third = substr($lastName,0,1);

        return strtoupper("$first$second$third")."-".$this->reg_user_id();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        $profilerecord=true;$setup = SystemSetup::take(1)->get()->first();
       return view("members.profile",compact("member","profilerecord","setup"));
    }

    public function institutions(Member $member){
        
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$this->get_member_institutions($member));
    }
    private function get_member_institutions($member){
        $data=[];
        $institutions = Institution::whereIn("institution_id",$this ->get_institution_ids($member->member_id))->get();
        foreach($institutions as $institution){
            $data[] = array("id"=>$institution->id,"name"=>$institution->name,"institution_id"=>$institution->institution_id,"logo"=>$institution->logo,"district"=>$institution->district->name,
            "institution_type"=>$institution->institution_type->name,"GPS_address"=>$institution->GPS_address,"POBox"=>$institution->POBox,"created_at"=>date('M d, Y h:i a', strtotime($institution->created_at)));
        }
        return $data;
    }
    public function institution_report(Member $member,Report $report){
        $institutions = Institution::whereIn("institution_id",$this ->get_institution_ids($member->member_id))->whereBetween('created_at', [$report->start_at, $report->end_at])->get();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$institutions);
    }
    private function get_institution_ids($member_id){
        $data=[];
        $member_institution = MemberInstitution::where("member_member_id",$member_id)->get();
        foreach($member_institution as $institution){
            $data[]=$institution->institution_institution_id;
        }
        return $data;
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
    public function generate_token(Member $member){
        $institution_id = trim(filter_var(request()->institution_id,FILTER_SANITIZE_STRING));
        if(empty($institution_id))
            return response()->json(["success"=>false,"message"=>"Please select institution to generate token"]);
        
        if(!Institution::where("institution_id",$institution_id)->get()->count())
            return response()->json(["success"=>false,"message"=>"Institution not found!"]);

        $token = $this ->filter_institution($institution_id)."-".$this->reg_user_id();
        if(TokenKey::where(["member_member_id"=>$member->member_id,"institution_institution_id"=>$institution_id])->get()->count())
            TokenKey::where(["member_member_id"=>$member->member_id,"institution_institution_id"=>$institution_id])->delete();
        
        TokenKey::create(["member_member_id"=>$member->member_id,"institution_institution_id"=>$institution_id,"token_key"=>$token]);
        return response()->json(["success"=>true,"message"=>"Successfully generated token key","token_key"=>$token]);

    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return response()->json(["success"=>true,"message"=>"Successfully removed member"]);
    }
}
