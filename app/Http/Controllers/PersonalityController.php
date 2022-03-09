<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personality;
use App\PersonalityCourse;
use App\PersonalityCourseRelated;
use App\CareerPath;
use App\SystemSetup;
use App\RelatedCareer;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PersonalityController extends ValidationRequest
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
        $personalityrecords = true;$setup = SystemSetup::take(1)->get()->first();
        return view("personalities.index",compact("personalityrecords","setup"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setup = SystemSetup::take(1)->get()->first();
        return view("personalities.create",compact("setup"));
    }

    public function courses(Personality $personality){

        $courserecords = true;$setup = SystemSetup::take(1)->get()->first();
        return view("personalities.courses.index",compact("personality","courserecords","setup"));
    }

    public function courses_list(Personality $personality){
        $course = PersonalityCourse::where("personality_id",$personality->id)->get();
        if($course->count()){
            $course = Personality::whereIn("id",$this ->get_course_personality($course->first()->id))->get();
        }
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$course);
    }

    private function get_course_personality($course_id){
        $data=[];
        foreach(PersonalityCourseRelated::where("personality_course_id",$course_id)->get() as $course_relate){
            $data[]=$course_relate->personality_id;
        }
        return $data;
    }
    public function courses_new(Personality $personality){
        $course = PersonalityCourse::where("personality_id",$personality->id)->get();
        $personalities=Personality::where("id","!=",$personality->id)->get();
        if($course->count())
            $course_related_personalities = $this ->get_course_personality($course->first()->id);
        else
            $course_related_personalities = [];

        $setup = SystemSetup::take(1)->get()->first();
        return view("personalities.courses.create",compact("personality","personalities","course_related_personalities","setup"));
    }

    public function courses_add(Personality $personality){
       
        if(!PersonalityCourse::where("personality_id",$personality->id)->get()->count())
            $course_id = PersonalityCourse::create(["personality_id"=>$personality->id])->id;
        else
            $course_id = PersonalityCourse::where("personality_id",$personality->id)->get()->first()->id;
        
        $this ->reset_course($course_id);
        foreach(request()->courses as $course){
            PersonalityCourseRelated::create(["personality_id"=>$course,"personality_course_id"=>$course_id]);
        }
        return response()->json(["success"=>true,"message"=>"Successfully added course related to ".$personality->name]);
    }
    private function reset_course($personality_course_id){
        PersonalityCourseRelated::where("personality_course_id",$personality_course_id)->delete();
    }

    public function career_path(Personality $personality){
        $careerpathrecords = true;$setup = SystemSetup::take(1)->get()->first();
        return view("personalities.careerpath.index",compact("personality","careerpathrecords","setup"));
    }

    public function career_path_list(Personality $personality){
        $careerpaths = CareerPath::where("personality_id",$personality->id)->get();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$careerpaths);
    }

    public function career_path_new(Personality $personality){
        $setup = SystemSetup::take(1)->get()->first();
        return view("personalities.careerpath.create",compact("personality","setup"));
    }

    public function career_path_save(Personality $personality){

        $careerpaths = trim(addslashes(request()->careerpaths));
        $alternative_name = trim(addslashes(request()->alternativeName));

        if(!CareerPath::where("name",$careerpaths)->get()->count()){
            $careerpath_id= CareerPath::create([
                 "id"=>$this->reg_user_id(),
                 "name"=>$careerpaths,
                 "alternative_name"=>$alternative_name,
                 "personality_id"=>$personality->id
             ]);
             $careerpath_id = $careerpath_id->id;
         }else{
             $careerpath_id = CareerPath::where("name",$careerpaths)->get()->first()->id;
         }
        return response()->json(["success"=>true,"message"=>"Successfully added career paths","cpid"=>$careerpath_id]);
    }
    public function career_path_edit(CareerPath $careerpath){
        $careerpath_name =trim(filter_var(request()->name,FILTER_SANITIZE_STRING));
        if(CareerPath::where(["name"=>$careerpath_name,"personality_id"=>$careerpath->personality_id])->get()->count())
            return response()->json(["success"=>false,"message"=>"$careerpath_name already exits!"]); 

        $careerpath->update(["name"=>$careerpath_name]);
        return response()->json(["success"=>true,"message"=>"Successfully updated career path"]); 
    }
    public function career_path_delete(CareerPath $careerpath){
        $careerpath->delete();
        return response()->json(["success"=>true,"message"=>"Successfully deleted career path"]); 
    }
    public function related_career_list(Personality $personality, CareerPath $careerpath){
        $related_careers = RelatedCareer::where("career_path_id",$careerpath->id)->get();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$related_careers);
    }

    public function related_career(Personality $personality, CareerPath $careerpath){
        $careerrecords = true;$setup = SystemSetup::take(1)->get()->first();
        return view("personalities.careerpath.careers.index",compact("personality","careerpath","careerrecords","setup"));
    }
    public function career_path_careers_new(Personality $personality, CareerPath $careerpath){
        $setup = SystemSetup::take(1)->get()->first();
        return view("personalities.careerpath.careers.create",compact("personality","careerpath","setup"));
    }

    public function career_path_careers_save(Personality $personality, CareerPath $careerpath){

        foreach(request()->careers as $career){
            if(!RelatedCareer::where(["name"=>$career,"career_path_id"=>$careerpath->id])->get()->count()){
                RelatedCareer::create(["name"=>$career,"career_path_id"=>$careerpath->id]);
            }
        }
        return response()->json(["success"=>true,"message"=>"Successfully added career"]); 
    }

    public function edit_career(RelatedCareer $career){
        $career_name = trim(filter_var(request()->name,FILTER_SANITIZE_STRING));
        if(RelatedCareer::where(["name"=>$career_name,"id"=>$career->career_path_id])->get()->count())
            return response()->json(["success"=>false,"message"=>"$career_name already exists!"]); 

        $career->update(["name"=>$career_name]);
        return response()->json(["success"=>true,"message"=>"Successfully updated careers"]); 
    }

    public function delete_career(RelatedCareer $career){
            $career->delete();
            return response()->json(["success"=>true,"message"=>"Successfully deleted careers"]); 
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Personality::where("name",trim(request()->name))->get()->count()){
            return response()->json(["success"=>false,"message"=>request()->name." already exists!"]);
        }
        $personality = Personality::create($this ->save_personality_info());
        return response()->json(["success"=>true,"message"=>"Successfully added new personality!","pid"=>$personality->id]);
    }
    private function save_personality_info(){
        return array(
            "id"=>$this->reg_user_id(),
            "name"=>trim(filter_var(request()->name,FILTER_SANITIZE_STRING)),
            "related_programme"=>trim(filter_var(request()->relatedProgramme,FILTER_SANITIZE_STRING)),
            "success_message"=>trim(request()->successMessage)
        );
    }

    public function list(){
        $personalities = Personality::all();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$personalities);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Personality $personality)
    {
        return view("personalities.courses",compact('personality'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Personality $personality)
    {
        $setup = SystemSetup::take(1)->get()->first();
        return view("personalities.edit",compact('personality',"setup"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Personality $personality)
    {
        $personality_name = trim(filter_var(request()->name,FILTER_SANITIZE_STRING));
        if(Personality::where("name",$personality_name)->where("id","!=",$personality->id)->get()->count())
        return response()->json(["success"=>false,"message"=>"$personality_name already exists!"]);
        $personality->update([
            "name"=>$personality_name,
            "related_programme"=>trim(filter_var(request()->relatedProgramme,FILTER_SANITIZE_STRING)),
            "success_message"=>trim(request()->successMessage)
        ]);
        return response()->json(["success"=>true,"message"=>"Successfully updated personality"]);
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
