<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuestionSetupScore;
use App\Member;
use App\Level;
use App\ClassName;
use App\TerminalReportSetup;
use App\MarkingScheme;
use App\SystemSetup;
use App\Subject;
use App\MemberTerminal;
class TerminalReportController extends Controller
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
    public function index(Member $member,QuestionSetupScore $question)
    {
        $setup = SystemSetup::take(1)->get()->first();
        $report = TerminalReportSetup::where(["question_setup_score_id"=>$question->id,"member_member_id"=>$member->member_id])->get();
        $levels = Level::all();
        $classes = ClassName::all();
        if(!$report->count()){
            return view("academics.terminal_report.setup",compact('setup','member','question','levels','classes'));
        }
    }

    public function save_setup(QuestionSetupScore $question){
        $level_id = preg_replace("#[^0-9]#","",request()->level);
        $term = preg_replace("#[^0-9]#","",request()->term);
        $classname_id = preg_replace("#[^0-9]#","",request()->classname);
        $marking_scheme = MarkingScheme::where(["institution_institution_id"=>$question->institution_institution_id,"level_id"=>$level_id,"status"=>"1"])->get();
        if(!$marking_scheme->count())
            return response()->json(["success"=>false,"message"=>"Please add marking scheme!"]);
        if(TerminalReportSetup::where(["question_setup_score_id"=>$question->id])->get()->count())
            return response()->json(["success"=>false,"message"=>"Pleaes, you have already setup terminal report!"]);

        $terminal= TerminalReportSetup::create(["question_setup_score_id"=>$question->id,"institution_institution_id"=>$question->institution_institution_id,"member_member_id"=>$question->member_member_id,"level_id"=>$level_id,"term"=>$term,"marking_scheme_id"=>$marking_scheme->first()->id,"class_name_id"=>$classname_id]);
        return response()->json(["success"=>true,"message"=>"Successfully setup terminal report","trid"=>$terminal->id]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(TerminalReportSetup $terminal)
    {
        $terminalreport=true;
        $setup = SystemSetup::take(1)->get()->first();
        $core_subjects = Subject::where("is_core","1")->orderBy("name","asc")->get();
        return view("academics.terminal_report.create",compact('setup','terminal','terminalreport','core_subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TerminalReportSetup $terminal)
    {
        $total_result = request()->count;
        if($total_result <4)
            return response()->json(["success"=>false,"message"=>"Please, enter scores for at least subjects! "]);
            if(MemberTerminal::where(["terminal_report_setup_id"=>$terminal->id])->get()->count()){
                MemberTerminal::where(["terminal_report_setup_id"=>$terminal->id])->delete();
            }

        for($i=0;$i<$total_result;$i++){
            $class_score = "class_score$i";
            $exams_score = "examsscore$i";
            $subject = "subject$i";
            $position = "position$i";
            $class_score = round(preg_replace("#[^0-9.]#","",request()->$class_score),2);
            $exams_score = round(preg_replace("#[^0-9.]#","",request()->$exams_score),2);
            $position = round(preg_replace("#[^0-9]#","",request()->$position));
            $total = round(($class_score + $exams_score),2);
            $subject = trim(request()->$subject);
            if($total < 0)
                return response()->json(["success"=>false,"message"=>"Please enter score for ".$this->subject_name($subject)."!"]);
            if($total > 100)
                return response()->json(["success"=>false,"message"=>"Please total score for ".$this->subject_name($subject)." can't be greater than 100"]);
            if($position == 0)
                return response()->json(["success"=>false,"message"=>"Please enter position for ".$this->subject_name($subject)."!"]);

            MemberTerminal::create(["terminal_report_setup_id"=>$terminal->id,"subject_id"=>$subject,"class_score"=>$class_score,"exams_score"=>$exams_score,"total"=>$total,"position"=>$position]);
            
        }
        return response()->json(["success"=>true,"message"=>"Successfully saved terminal report","quid"=>$terminal->question_setup_score_id,"mid"=>$terminal->member_member_id]);
    }

    public function subject_name($id){
        return Subject::where("id",$id)->get()->first()->name;
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
