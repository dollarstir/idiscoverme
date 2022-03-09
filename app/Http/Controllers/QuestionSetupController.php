<?php

namespace App\Http\Controllers;
use App\QuestionSetup;
use App\Question;
use App\Personality;
use App\SystemSetup;
use Illuminate\Http\Request;

class QuestionSetupController extends ValidationRequest
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
    public function index()
    {
        //
        
        $questionsetuprecords = true;$setup = SystemSetup::take(1)->get()->first();
        return view("questions.setup.index",compact("questionsetuprecords","setup"));
    }

    public function question_setup_list(){
        $question_setups  = QuestionSetup::orderBy("created_at","desc")->get();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$question_setups);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(QuestionSetup $questionsetup)
    {
        $personalities = Personality::all();$setup = SystemSetup::take(1)->get()->first();
        return view("questions.create",compact("questionsetup","personalities","setup"));
    }

    public function setup(){
        $setup = SystemSetup::take(1)->get()->first();
        return view("questions.setup.create",compact("setup"));
    }

    public function setup_update(QuestionSetup $questionsetup){
        $name = trim(addslashes(request()->name));
        if(QuestionSetup::where("name",$name)->where("id","!=",$questionsetup->id)->get()->count())
        return response()->json(["success"=>false,"message"=>"$name already exists!"]);

        if(empty($name))
        return response()->json(["success"=>false,"message"=>"Question setup name required!"]);

        $questionsetup->update(["name"=>$name]);
        return response()->json(["success"=>true,"message"=>"Successfully updated question setup!"]);
    }

    public function setup_delete(QuestionSetup $questionsetup){
        $questionsetup->delete();
        return response()->json(["success"=>true,"message"=>"Successfully deleted question setup!"]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionSetup $questionsetup)
    {
        $career_path_id = trim(filter_var(request()->career_path_id,FILTER_SANITIZE_STRING));
        foreach(request()->questions as $question){
            $question = trim($question);
            $question_number = Question::where(["question_setup_id"=>$questionsetup->id])->get()->count()+1;
            if(!empty($question))
                Question::create(["question_number"=>$question_number,"question_setup_id"=>$questionsetup->id,"career_path_id"=>$career_path_id,"question"=>trim(addslashes($question))]);

        }
        return response()->json(["success"=>true,"message"=>"Successfully added new questions!"]);
    }

    public function save_setup(){
        $name = trim(addslashes(request()->name));
        if(QuestionSetup::where("name",$name)->get()->count())
        return response()->json(["success"=>false,"message"=>"$name already exists!"]);

        $questionSetup = QuestionSetup::create(["id"=>$this->reg_user_id(),"name"=>$name]);
        return response()->json(["success"=>true,"message"=>"Successfully added new question setup!","qsid"=>$questionSetup->id]);
    }

    public function questions(QuestionSetup $questionsetup){
        $questionrecords = true;$setup = SystemSetup::take(1)->get()->first();
        return view("questions.index",compact('questionsetup','questionrecords','setup'));
    }

    public function question_lists(QuestionSetup $questionsetup){
        $questions = Question::where("question_setup_id",$questionsetup->id)->orderBy("question_number","asc")->get();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$questions);
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
    public function update(Question $question)
    {//
        $question->update(["question"=>trim(addslashes(request()->question))]);
        return response()->json(["success"=>true,"message"=>"Successfully updated question!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return response()->json(["success"=>true,"message"=>"Successfully deleted question!"]);
    }
}
