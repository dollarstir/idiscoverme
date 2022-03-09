<?php

namespace App\Http\Controllers;
use App\InstitutionType;
use App\Region;
use App\InstitutionEmailAddress;
use App\MemberInstitution;
use App\Member;
use App\Level;
use App\InstitutionContact;
use App\Institution;
use App\SystemSetup;
use App\TokenKey;
use App\MarkingScheme;
use App\Report;
use Excel;
use Illuminate\Http\Request;

class InstitutionsController extends ValidationRequest
{
    public $get_tokens;

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutionrecords = true;$setup = SystemSetup::take(1)->get()->first();
        return view('institutions.index',compact('institutionrecords','setup'));
    }

    public function add_member_institution(Member $member){
        $addmemberinstitutionrecords=true;$setup = SystemSetup::take(1)->get()->first();
        return view("institutions.add_institutions",compact('member','addmemberinstitutionrecords','setup'));
    }
    public function add_member_institution_list(Member $member){
        
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$this->get_new_insitution_for_member($member));
    }
    private function get_new_insitution_for_member($member){
        $data=[];
        $institutions = Institution::whereNotIn("institution_id",$this ->member_institutions($member))->get();
        foreach($institutions as $institution){
            $data[] = array("id"=>$institution->id,"name"=>$institution->name,"institution_id"=>$institution->institution_id,"logo"=>$institution->logo,"district"=>$institution->district->name,
            "institution_type"=>$institution->institution_type->name,"GPS_address"=>$institution->GPS_address,"POBox"=>$institution->POBox,"created_at"=>date('M d, Y h:i a', strtotime($institution->created_at)));
        }
        return $data;
    }
    public function member_institutions($member){
        $data=[];
       $institutions =  MemberInstitution::where("member_member_id",$member->member_id)->get();
       foreach($institutions as $institution){
            $data[]=$institution->institution_institution_id;
       }
       return $data;
    }

    public function add_member_institutions(Member $member){

        foreach(request()->institutions as $institution){
            if(Institution::where("institution_id",$institution)->get()->count()){
                if(!MemberInstitution::where(["institution_institution_id"=>$institution,"member_member_id"=>$member->member_id])->get()->count())
                    MemberInstitution::create(["institution_institution_id"=>$institution,"member_member_id"=>$member->member_id]);
            }
        }
        return response()->json(["success"=>true,"message"=>"Successfully added institution(s)"]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institutiontypes = InstitutionType::all();

        $regions = Region::orderBy('name','asc')->get();
        $setup = SystemSetup::take(1)->get()->first();
        return view('institutions.create',compact('institutiontypes','regions','setup'));
    }

    public function generateToken(Institution $institution){
        
        if(TokenKey::where("institution_institution_id",$institution->institution_id)->get()->count())
            TokenKey::where("institution_institution_id",$institution->institution_id)->delete();

        if($institution->member_instutitons->count()){
            foreach($institution->member_instutitons as $member){
                $token = $this ->filter_institution($institution->institution_id)."-".$this->reg_user_id();
                if(!TokenKey::where(["member_member_id"=>$member->member_member_id,"institution_institution_id"=>$institution->institution_id])->get()->count())
                TokenKey::create(["member_member_id"=>$member->member_member_id,"institution_institution_id"=>$institution->institution_id,"token_key"=>$token]);
            }
            return response()->json(["success"=>true,"message"=>"Successfully generated tokens"]);
        }else{   
            return response()->json(["success"=>false,"message"=>"Please, no member found!"]);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            $id = $this ->gen_institution();
            Institution::create([
                "institution_id"=>$id,
                "name"=>trim(filter_var(request()->name,FILTER_SANITIZE_STRING)),
                "GPS_address"=>trim(filter_var(request()->gpsaddress,FILTER_SANITIZE_STRING)),
                "institution_type_id"=>trim(filter_var(request()->instypeid,FILTER_SANITIZE_STRING)),
                "district_id"=>trim(filter_var(request()->district,FILTER_SANITIZE_STRING)),
                "POBox"=>trim(filter_var(request()->pobox,FILTER_SANITIZE_STRING)),
                "logo"=>$this->store_institution_logo()
            ]);
            $this->store_institution_contacts($id);
            $this->store_institution_address($id);
            return response()->json(["success"=>true,"message"=>"Successfully added ".request()->name,"inid"=>$id]);

    }

    private function institution_basic_info(){
        return array(
            
        );
    }
    private function gen_institution(){
        $name = trim(filter_var(request()->name,FILTER_SANITIZE_STRING));
        $first="";$middle="";$last="";
        $institution_id = $this->reg_user_id();
        $explode = explode(" ",$name);
        
        if(count($explode) > 0){
            $first = substr($explode[0],0,1);
        }
        
        if(count($explode) > 1){
            $middle = substr($explode[1],0,1);
        }else{
            $middle = substr($explode[0],strlen($explode[0])-1,1);
        }

        if(count($explode) > 2){
            $last = substr($explode[1],0,1);
        }else{
            if(count($explode) > 1){
                $last = substr($explode[1],strlen($explode[1])-1,1);
            }else{
                $last = substr($explode[0],strlen($explode[0])-1,1);
            }
        }
        return strtoupper("$first$middle$last-$institution_id");
    }
    private function store_institution_logo(){
        if(request()->hasFile('file')){
            $imagedata = file_get_contents(request()->file('file'));
            $base64 = base64_encode($imagedata);
            return $base64;
        }
        return "";
    }
    private function store_institution_contacts($institution_id){
        foreach(request()->phone as $phone){
            if(!InstitutionContact::where("phoneNumber",$phone)->get()->count()){
                InstitutionContact::create(["phoneNumber"=>$phone,"institution_institution_id"=>$institution_id]);
            }
        }
    }
    private function store_institution_address($institution_id){
        foreach(request()->email as $email){
            if(!InstitutionEmailAddress::where("address",$email)->get()->count()){
                InstitutionEmailAddress::create(["address"=>$email,"institution_institution_id"=>$institution_id]);
            }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Institution $institution)
    {
        $institutionprofilerecords=true;$setup = SystemSetup::take(1)->get()->first();
        return view('institutions.detail',compact('institution','institutionprofilerecords','setup'));
    }

    public function list(){
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$this->list_all_institutions());
    }

    public function list_all_institutions(){
        $data=[];
        $institutions = Institution::all();
        foreach($institutions as $institution){
            $data[] = array("id"=>$institution->id,"name"=>$institution->name,"institution_id"=>$institution->institution_id,"logo"=>$institution->logo,"district"=>$institution->district->name,
            "institution_type"=>$institution->institution_type->name,"GPS_address"=>$institution->GPS_address,"POBox"=>$institution->POBox,"created_at"=>date('M d, Y h:i a', strtotime($institution->created_at)));
        }
        return $data;
    }
    public function members(Institution $institution){
        $institutions = Member::whereIn("member_id",$this ->get_institution_members($institution->institution_id))->get();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$institutions);
    }
    public function member_report(Institution $institution,Report $report){
        $institutions = Member::whereIn("member_id",$this ->get_institution_members_report($institution->institution_id,$report))->get();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$institutions);
    }
    public function remove_member(Institution $institution){
        $member_id = trim(request()->member_id);
        $info = MemberInstitution::where("member_member_id",$member_id)->get();
        if($info->count()){
            MemberInstitution::where("member_member_id",$member_id)->delete();
            return response()->json(["success"=>true,"successfully removed member"]);
        }
        return response()->json(["success"=>false,"Member not found!"]);
    }
    public function get_institution_members_report($institution_id,$report){
        $data=[];
        $institution_members = MemberInstitution::whereBetween('created_at', [$report->start_at, $report->end_at])->where("institution_institution_id",$institution_id)->get();
        foreach($institution_members as $member){
            $data[]=$member->member_member_id;
        }
        return $data;
    }
    public function get_institution_members($institution_id){
        $data=[];
        $institution_members = MemberInstitution::where("institution_institution_id",$institution_id)->get();
        foreach($institution_members as $member){
            $data[]=$member->member_member_id;
        }
        return $data;
    }
    public function add_marking_scheme(Institution $institution){
        $level= preg_replace("#[^0-9]#","",request()->level);
        $class_score= preg_replace("#[^0-9.]#","",request()->class_score);
        $exams_score= preg_replace("#[^0-9]#","",request()->exams_score);
        

        $total = (int)$class_score + (int)($exams_score);
        $level_name = Level::where("id",$level)->get();
        if(!$level_name->count())
            return response()->json(["success"=>false,"message"=>"No level found!"]);
        
        $level_name = $level_name->first()->name;
        if(!empty($level)){
            if($total==100){
                if(!MarkingScheme::where(["level_id"=>$level,"institution_institution_id"=>$institution->institution_id])->get()->count()){
                    MarkingScheme::create(["level_id"=>$level,"institution_institution_id"=>$institution->institution_id,"class_score"=>$class_score,"exams_score"=>$exams_score]);
  
                }else{
                    MarkingScheme::where(["level_id"=>$level,"institution_institution_id"=>$institution->institution_id])->update(["class_score"=>$class_score,"exams_score"=>$exams_score]);
                }
                return response()->json(["success"=>true,"message"=>"Successfully set marking scheme for $level_name"]);
            }
            return response()->json(["success"=>false,"message"=>"class score and exams score should sum upto 100"]);
        }
        return response()->json(["success"=>false,"message"=>"All fields required!"]);
    }
    public function setup_marking_scheme(Institution $institution){

        $levels = Level::orderBy('name','asc')->get();
        $setup = SystemSetup::take(1)->get()->first();
        return view('institutions.marking_scheme',compact('levels','institution','setup'));
    }
    public function marking_scheme(Institution $institution){

        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$this->fetch_marking_scheme($institution));
    }
    function fetch_marking_scheme($institution){
        $data=[];

        $marking_schemes = MarkingScheme::where("institution_institution_id",$institution->institution_id)->get();

        foreach($marking_schemes as $marking_scheme){
            $data=array("id"=>$marking_scheme->id,"level"=>$marking_scheme->level->name,"class_score"=>$marking_scheme->class_score,"exams_score"=>$marking_scheme->exams_score);
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
    public function destroy(Institution $institution)
    {
        $institution->delete();
        return response()->json(["success"=>true,"message"=>"Successfully deleted institution"]);
    }

    public function download_token(Institution $institution){
        $this->tokens = TokenKey::where("institution_institution_id",$institution->institution_id)->get();
        
        if($this->tokens->count()){
            Excel::create($institution->name."-".date('Y-m-d',time()), function($excel) {

                $excel->sheet('Sheetname', function($sheet) {
                    $sheet->mergeCells("A1:D1");//merge for title
                    $sheet->row(1, function ($row) {
                        $row->setFontSize(14);
                        $row->setAlignment('center');
                        $row->setFontWeight('bold');
                    });
                    $sheet->row(1,array("Discover-me Members Token Sheet"));
                    $sheet->row(2,$this->headings());
                    $i=3;$n=1;
                    foreach($this->tokens as $token){
                        $sheet->row($i,array(
                            $n,
                            $token->member_member_id,
                            $token->member->firstName." ".$token->member->middleName." ".$token->member->lastName,
                            $token->token_key
                        ));

                        $i++;$n++;
                    }
                });
            
            })->download("xlsx");
        }
    }
    private function headings(){
        
        return array("S/N","MEMBER ID","MEMBER NAME","TOKEN KEY");
    }
}
