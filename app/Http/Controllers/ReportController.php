<?php

namespace App\Http\Controllers;
use App\SystemSetup;
use App\Report;
use App\Member;
use App\QuestionScore;
use App\Institution;
use App\InstitutionType;
use App\Guardian;
use App\QuestionSetupScore;
use Auth;
use Illuminate\Http\Request;

class ReportController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setup = SystemSetup::take(1)->get()->first();
        $report=true;
        return view("report.create",compact("setup","report"));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = trim(addslashes(request()->name));
        $report_type = preg_replace("#[^0-9]#","",request()->type);
        $start_at = preg_replace("#[^0-9-]#","",request()->start_at);
        $end_at = preg_replace("#[^0-9-]#","",request()->end_at);
        if(empty($name) || empty($start_at) || empty($end_at))
            return response()->json(["success"=>false,"message"=>"All fields required!"]);

        Report::where("user_id",Auth::user()->id)->delete();
        $id = Report::create(["user_id"=>Auth::user()->id,"name"=>$name,"type"=>$report_type,"start_at"=>$start_at,"end_at"=>$end_at]);
        return response()->json(["success"=>true,"message"=>"Successfully prepared report!","rid"=>$id->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        $setup = SystemSetup::take(1)->get()->first();
        $reportrecords=true;
        return view("report.index",compact("setup","report","reportrecords"));
    }

    public function members_list(Report $report){
        
        $members = Member::where("account_status","1")->whereBetween('created_at', [$report->start_at, $report->end_at])->get();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$members);
    }
    public function institution_list(Report $report){
        $institutions = Institution::where("status","1")->whereBetween('created_at', [$report->start_at, $report->end_at])->get();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$institutions);
    }

    public function guardian_list(Report $report){
        $guardians = Guardian::whereBetween('created_at', [$report->start_at, $report->end_at])->get();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$guardians);
    }

    public function question_setup_list(Report $report){
        $question_setups = $this->question_setup($report);
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$question_setups);
    }

    public function question_setup($report){
        $data=[];
        $question_setup = QuestionSetupScore::whereBetween('created_at', [$report->start_at, $report->end_at])->groupBy("question_setup_id")->get();

        foreach($question_setup as $question){
            $data[]=array("name"=>$question->question_setup->name,"strong_dislike"=>$question->get_total_scores($question->id,1),"dislike"=>$question->get_total_scores($question->id,2),"not_sure"=>$question->get_total_scores($question->id,3),"like"=>$question->get_total_scores($question->id,4),"strongly_like"=>$question->get_total_scores($question->id,5));
        }
        return $data;
    }

    public function report_statistics(Report $report){
        $setup = SystemSetup::take(1)->get()->first();
        $statistics = true;
        return view("report.statistics",compact("setup","report","statistics"));
    }

    public function report_statistics_list(Report $report){
        $institution_type = $this->get_institution_type($report);
        $members = $this->members_data($report);
        $guardians = $this->guardian_data($report);
        $question_setup_data = $this->question_setup_data($report);
        return response()->json(["success"=>true,"institution_type"=>$institution_type,"members"=>$members,"guardians"=>$guardians,"question_setup_data"=>$question_setup_data]);
    }
    private function get_institution_type($report){
        $data = [];
        $institution_type  = InstitutionType::all();
        foreach($institution_type as $type){
            $data[]=array("name"=>$type->name,"total"=>$this->get_institution_registered($type,$report));
        }
        return $data;
    }
    private function members_data($report){
        $data=[];
        $male_count = Member::where(["account_status"=>"1","gender"=>"0"])->whereBetween('created_at', [$report->start_at, $report->end_at])->get()->count();
        $female_count=Member::where(["account_status"=>"1","gender"=>"1"])->whereBetween('created_at', [$report->start_at, $report->end_at])->get()->count();
        $data[]=array("male"=>$male_count,"female"=>$female_count);
        return $data;
    }
    private function get_institution_registered($type,$report){
        return Institution::whereBetween('created_at', [$report->start_at, $report->end_at])->where("institution_type_id",$type->id)->get()->count();

    }
    private function guardian_data($report){
        $data=[];
        $mother = Guardian::whereBetween('created_at', [$report->start_at, $report->end_at])->where("type","0")->get()->count();
        $father = Guardian::whereBetween('created_at', [$report->start_at, $report->end_at])->where("type","1")->get()->count();
        $guardian = Guardian::whereBetween('created_at', [$report->start_at, $report->end_at])->where("type","2")->get()->count();

        $data[]=array("mother"=>$mother,"father"=>$father,"guardian"=>$guardian);
        return $data;
    }

    private function question_setup_data($report){
        $data=[];
        for($i=1;$i<=5;$i++)
        $data[]= QuestionScore::whereBetween('created_at', [$report->start_at, $report->end_at])->where("score","$i")->get()->count();

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

    public function search(Report $report,$search){
        $search = filter_var($search,FILTER_SANITIZE_STRING);
        $setup = SystemSetup::take(1)->get()->first();
        if($report->type==1){
            $profilerecord=true;
            $member = Member::where(["account_status"=>"1","member_id"=>$search])->whereBetween('created_at', [$report->start_at, $report->end_at])->get();
            return view("report.search.institution",compact("setup","report","search","member","profilerecord"));
        }
        if($report->type==3){
            $institutionprofilerecords=true;
            $institution = Institution::whereBetween('created_at', [$report->start_at, $report->end_at])->where("institution_id",$search)->get();
            return view("report.search.institution",compact("setup","report","search","institution","institutionprofilerecords"));
        }
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
    public function destroy($id)
    {
        //
    }
}
