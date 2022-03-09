<?php

namespace App\Http\Controllers;
use App\Institution;
use App\TokenKey;
use App\QuestionSetup;
use App\QuestionSetupScore;
use App\Question;
use App\QuestionScore;
use App\CareerPathScore;
use App\CareerPath;
use App\PersonalityScore;
use App\Personality;
use App\DorminantPersonality;
use App\Member;
use App\Report;
use App\SystemSetup;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class QuestionnaireController extends ValidationRequest
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Institution $institution)
    {
        $institution_initials = $this ->getInstitutionInitials($institution->institution_id);
        $setup = SystemSetup::take(1)->get()->first();
        return view('questionnaire.index',compact('institution','institution_initials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Institution $institution)
    {
        $token_session = trim(request()->session()->get('t_session', ''));
        if(empty($token_session))
            return redirect("/$institution->institution_id");
        $member = Member::where("member_id",$token_session)->get();
        if(!$member->count())
            return redirect("/$institution->institution_id");
        $member = $member->first();
        $question_setup = QuestionSetup::whereNotIn("id",$this ->questionSetupScore($token_session))->take(1)->get();
        $setup = SystemSetup::take(1)->get()->first();
        return view('questionnaire.questions',compact('institution','question_setup','member',"setup"));
    }

    private function questionSetupScore($member_id){
        $data=[];
        $question_setup_scores = QuestionSetupScore::where("member_member_id",$member_id)->get();
        foreach($question_setup_scores as $question_setup_score){
            $data[] = $question_setup_score->question_setup_id;
        }
        return $data;
    }

    public function questions_answered(Member $member){
        $question_setup = QuestionSetupScore::where("member_member_id",$member->member_id)->get();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$question_setup);
    }
    public function questions_answered_report(Member $member,Report $report){
        $question_setup = QuestionSetupScore::where("member_member_id",$member->member_id)->whereBetween('created_at', [$report->start_at, $report->end_at])->get();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$question_setup);
    }
    
    public function answers(Institution $institution){
        $token_session = trim(request()->session()->get('t_session', ''));
        if(empty($token_session))
        return redirect("/$institution->institution_id");

        if(!isset(request()->total_questions))
            return back()->with("error","Please, no questions found!");
        $question_setup_score_id="";

        $member = Member::where("member_id",$token_session)->get();
        if(!$member->count())
            return redirect("/$institution->institution_id/questions/error");

        $member = $member->first();
        $total_questions = preg_replace("#[^0-9]#","",request()->total_questions);


        for($i=0;$i<$total_questions;$i++){
            $question_id = "id_$i";
            $answer_selected = "question_$i";
            $question_setup_id="";

            $question_id = preg_replace("#[^0-9]#","",request()->$question_id);
            $answer_selected = preg_replace("#[^0-9]#","",request()->$answer_selected);

            if(Question::where("id",$question_id)->get()->count()){
                $question_setup_id=Question::where("id",$question_id)->get()->first()->question_setup_id;

                //already answered question
                if(!QuestionSetupScore::where(["member_member_id"=>$token_session,"question_setup_id"=>$question_setup_id])->get()->count())
                    $question_setup_score_id = QuestionSetupScore::create(["member_member_id"=>$token_session,"question_setup_id"=>$question_setup_id,"institution_institution_id"=>$institution->institution_id,"age"=>$member->getAge($member->dateOfBirth)])->id;
                else
                    $question_setup_score_id = QuestionSetupScore::where(["member_member_id"=>$token_session,"question_setup_id"=>$question_setup_id])->get()->first()->id;
                
                if(!QuestionScore::where(["question_setup_score_id"=>$question_setup_score_id,"question_id"=>$question_id])->get()->count())
                    QuestionScore::create(["question_setup_score_id"=>$question_setup_score_id,"question_id"=>$question_id,"score"=>$answer_selected]);
            }

        }
        
        if(!CareerPathScore::where("question_setup_score_id",$question_setup_score_id)->get()->count()){
            $careerpaths= CareerPath::all();
            foreach($careerpaths as $careerpath){
                $career_path_total_score = 0;
                $question_score = 0;
                foreach($careerpath->questions as $question){
                    if($question->question_scores->where("question_setup_score_id",$question_setup_score_id)->count())
                    $question_score += $question->question_scores->where("question_setup_score_id",$question_setup_score_id)->first()->score;
                    
                }
                if($question_score > 0 && !CareerPathScore::where(["question_setup_score_id"=>$question_setup_score_id,"career_path_id"=>$careerpath->id])->get()->count()){
                     $career_path_total_score = $question_score;
                     CareerPathScore::create(["question_setup_score_id"=>$question_setup_score_id,"career_path_id"=>$careerpath->id,"score"=>$career_path_total_score]);
                }
             }
         }
         
         if(!PersonalityScore::where("question_setup_score_id",$question_setup_score_id)->get()->count()){
             $personalities = Personality::all();
             foreach($personalities as $personalityinfo){
                 $personality_score = 0;
                 foreach($personalityinfo->career_paths as $career_path){
                     if($career_path->career_path_scores->where("question_setup_score_id",$question_setup_score_id)->count())
                         $personality_score += $career_path->career_path_scores->where("question_setup_score_id",$question_setup_score_id)->first()->score;
                 }
                 PersonalityScore::create(["question_setup_score_id"=>$question_setup_score_id,"personality_id"=>$personalityinfo->id,"score"=>$personality_score]);
             }
         }
         
         if(!DorminantPersonality::where("question_setup_score_id",$question_setup_score_id)->get()->count()){
            $data=[];
            $total_personalities = Personality::count();
            $scores = PersonalityScore::where("question_setup_score_id",$question_setup_score_id)->orderBy('score','desc')->get();
            foreach($scores as $score){
                if(!in_array($score->score,$data)){
                    $data[]=$score->score;
                }
            }
            $temp_index = 1;
            foreach($data as $value){
                $request = PersonalityScore::where(["question_setup_score_id"=>$question_setup_score_id,"score"=>$value])->orderBy('score','desc')->get();
                if($request->count() > 1){
                    foreach($request as $personality){
                        $personality_course_related_score = 0;
                        foreach($personality->personality->personality_courses as $personality_course){
                            foreach($personality_course->personality_course_relate as $course_related){
                                $personality_course_related_score += $course_related->personality->personality_scores->where("question_setup_score_id",$question_setup_score_id)->first()->score;
                            }
                        }
                        if(!DorminantPersonality::where(["personality_id"=>$personality->personality_id,"position"=>$temp_index,"question_setup_score_id"=>$question_setup_score_id])->get()->count())
                          DorminantPersonality::create(["personality_id"=>$personality->personality_id,"position"=>$temp_index,"question_setup_score_id"=>$question_setup_score_id,"score"=>$personality_course_related_score]);
                
                    }
                }else{
                    if(!DorminantPersonality::where(["personality_id"=>$request->first()->personality_id,"position"=>$temp_index,"question_setup_score_id"=>$question_setup_score_id])->get()->count())
                       DorminantPersonality::create(["personality_id"=>$request->first()->personality_id,"position"=>$temp_index,"question_setup_score_id"=>$question_setup_score_id,"score"=>$value]);
                }
                $temp_index++;
            }
            
                
         }
         
         return redirect("/$institution->institution_id/success");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function success(Institution $institution){
        $token_session = trim(request()->session()->get('t_session', ''));
        if(empty($token_session))
        return redirect("/$institution->institution_id");
        TokenKey::where("member_member_id",$token_session)->delete();
        $member = Member::where("member_id",$token_session)->get()->first();
        $success=true;
        $question_setup = QuestionSetup::whereNotIn("id",$this ->questionSetupScore($token_session))->take(1)->get();
        
        request()->session()->put('t_session', '');
        return view('questionnaire.questions',compact('institution','question_setup','member','success'));
    }
    public function to_questions(Institution $institution){
        return redirect("$institution->institution_id/questions");
    }
    public function instructions(Institution $institution){
        $token_session = trim(request()->session()->get('t_session', ''));
        if(empty($token_session))
            return redirect("/$institution->institution_id");
        $member = Member::where("member_id",$token_session)->get();
        if(!$member->count())
            return redirect("/$institution->institution_id");
        $member = $member->first();
        $setup = SystemSetup::take(1)->get()->first();
    
        return view('questionnaire.instructions',compact('institution','member',"setup"));
    }
    public function store(Institution $institution)
    {
        //ICC-795180
       $token = trim(filter_var(request()->token,FILTER_SANITIZE_STRING));
       request()->validate([
           "token"=>"required|string|min:6"
       ]);
    
       $auth = TokenKey::where("token_key",$token)->get();
       if($auth->count()){
            request()->session()->put('t_session', $auth->first()->member_member_id);
            return redirect("/$institution->institution_id/instructions");
       }
       return back()->with("error","Please enter a valid token to continue");
    }

}
