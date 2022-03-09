<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Personality;
use App\QuestionSetup;
use App\QuestionSetupScore;
use App\PersonalityScore;
use App\DorminantPersonality;
use App\Question;
use App\Classes\EasyTable;
use App\Classes\CreatePage;

class QuestionnaireReport extends Controller
{
    public $data=[];
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Member $member,QuestionSetup $questionset)
    {
        $personalities_first = Personality::take(3)->orderBy('created_at','asc')->get();
        $question_set_score = QuestionSetupScore::where(["member_member_id"=>$member->member_id,"question_setup_id"=>$questionset->id])->get();
        if(!$question_set_score->count())
            return back()->with("error","Sorry!, we cannot find the questions answered");

        $question_set_score= $question_set_score->first();
        $pdf=new CreatePage(); 
        $pdf->AliasNbPages();

        $pdf->AddPage('P','A4');
        $pdf->SetFont('Times','',10);
        $table=new easyTable($pdf, '{20,30, 30,30,30,35,30,30,30,35}','align:C{LCRR};border:1; border-color:#000000; ');
        $this ->header($member,$table,$question_set_score,$pdf);
        $this ->load_questions($pdf,$questionset,$question_set_score,$table);
        
        $pdf->AddPage('L','A4');
        $pdf->SetFont('Times','',10);
        
        $this ->personality_score_sheet($pdf,$member,$question_set_score,$questionset);

        $pdf->AddPage('P','A4');
        $pdf->SetFont('Times','',10);
        $this->dominant_personality($member,$pdf,$questionset,$question_set_score);

        $pdf->Output();
        exit;
    }
    
    private function dominant_personality($member,$pdf,$questionset,$question_set_score){
        
        $table=new easyTable($pdf, '{20,30, 30,30,30,35,30,30,30,35}','align:C{LCRR};border:1; border-color:#000000; ');
        $this ->header($member,$table,$question_set_score,$pdf);
        $table->endTable();
        $table=new easyTable($pdf, '{30, 30,30,30,35,30}','align:C{LLLL};border:1; border-color:#000000; ');
        $table->rowStyle('align:{CCCC}; font-color:#000000; font-family:times;font-size:11; font-style:B;');
        $table->easyCell(strtoupper("Report on TUCEE Personality Psychometric Test"),'colspan:6;font-style:B;font-size:12;paddingY:4;paddingX:3;border:0;');
        $table->printRow();

        /*
        $table->rowStyle('align:{LLLLLL}; font-color:#000000; font-family:times;font-size:11; font-style:B;');
        $table->easyCell('Identified Highest Interest Area:','colspan:18;font-style:B;font-size:12;paddingY:4;paddingX:3;border:0;');
        $table->printRow();
        
        */
       
        $temp_index = 1;
        
        $dominant = DorminantPersonality::where("question_setup_score_id",$question_set_score->id)->orderBy('position','asc')->get();
        
        foreach($dominant as $dominant_score){
                if(!in_array($dominant_score->position,$this->data)){
                   $this->data[]= $dominant_score->position;
                }
        }
           /*  
        foreach($this->data as $value){
                $final_score = DorminantPersonality::where(["question_setup_score_id"=>$question_set_score->id,"position"=>$value])->orderBy("score","desc")->get();
                    foreach($final_score as $score){
                        $table->easyCell($this ->ordinal($temp_index)." ( ".$score->personality->personality_scores->first()->score." )",'colspan:1;font-size:12;paddingY:4;paddingX:3;border:TBRL;');
                        if($temp_index > 1 && ($temp_index % 6)==0){
                            $table->printRow();
                        }
                        $temp_index++;
                }
        }
           $table->printRow();
           $pdf->Ln(3);
    
        */
        $table->printRow();
        $table->endTable();
        
        $temp_index=1;
        $table=new easyTable($pdf, '{10, 53,10,50,10,50}','align:C{LLLL};border:1; border-color:#000000; ');
        $table->rowStyle('align:{LLLLL}; font-color:#000000; font-family:times;font-size:11; font-style:B;');
        $table->easyCell('Personalities','colspan:6;font-style:B;font-size:12;paddingY:4;paddingX:3;border:0;');
        $table->printRow();
        $n=0;
        
        foreach($dominant as $dominant_score){
            if(!in_array($dominant_score->position,$this->data)){
               $this->data[]= $dominant_score->position;
            }
        }

        foreach($this->data as $value){
            $final_score = DorminantPersonality::where(["question_setup_score_id"=>$question_set_score->id,"position"=>$value])->orderBy("score","desc")->get();
            foreach($final_score as $score){
                $table->easyCell(($temp_index),'colspan:1;font-size:12;paddingY:4;paddingX:3;border:BLR;');
                $table->easyCell($score->personality->name,'colspan:1;font-size:12;paddingY:4;paddingX:3;border:BR;');
                if($temp_index > 1 && ($temp_index % 3)==0){
                    $table->printRow();
                }    
                $temp_index++;
            } 
            
        }
        $table->printRow();$pdf->Ln(5);

        $table->rowStyle('align:{L}; font-color:#000000; font-family:times;font-size:11;');
        $table->easyCell("Dominant Personlity ",'colspan:2;font-size:11;paddingY:2;paddingX:3;border:B');
        $table->easyCell("<b>".$this->get_dominant_personality($question_set_score->id)['personality_name']."</b>",'colspan:14;font-size:15;paddingY:2;paddingX:3;border:B');
        $table->printRow();
        $table->rowStyle('align:{L}; font-color:#000000; font-family:times;font-size:11;bgcolor:#D3D3D3;');
        $table->easyCell($this->get_dominant_personality($question_set_score->id)['personality_success_message'],'colspan:14;font-size:11;paddingY:2;paddingX:3;border:B');
        $table->printRow();

        $pdf->Ln(15);

        $personality = DorminantPersonality::where(["question_setup_score_id"=>$question_set_score->id,"position"=>$this->data[0]])->orderBy("score","desc")->get()->first();
        $table->rowStyle('valign:M;align:{CCCCCCCCCCCCCC}; font-color:#000000; font-family:times;font-size:10; font-style:B;');
        $table->easyCell(strtoupper($personality->personality->name),'valign:M;align:{CCC};colspan:6;font-style:B;font-size:15;paddingY:5;paddingX:3;');
        $table->printRow();

        $table->rowStyle('valign:M;align:{CCCCCCCCCCCCCC}; font-color:#000000; font-family:times;font-size:11;');
        $table->easyCell($personality->personality->related_programme,'colspan:6;font-size:12;font-style:B;paddingY:2;paddingX:3;');
        $table->printRow();

        foreach($personality->personality->career_paths as $career_paths){
                $table->rowStyle('align:{CCCCCCCCCCCCCC}; font-color:#000000; font-family:times;font-size:11;');
                $table->easyCell($career_paths->name,'colspan:2;font-size:12;font-style:B;paddingY:2;paddingX:3;');
        }
        $table->printRow();
        
        for($i=0;$i < $personality->totalCareers($personality->personality_id);$i++){
        foreach($personality->personality->career_paths as $career_paths){
            $table->rowStyle('valign:M;align:{CCCCCCCCCCCCCC}; font-color:#000000; font-family:times;font-size:11;');
            if($career_paths->get_related_career($career_paths->id,$i)->count()){
               foreach($career_paths->get_related_career($career_paths->id,$i) as $career){
                if($i == ($personality->totalCareers($personality->personality_id)-1))
                   $table->easyCell($career->name,'colspan:2;font-size:12;paddingY:2;paddingX:3;border:LRB');
                else
                   $table->easyCell($career->name,'colspan:2;font-size:12;paddingY:2;paddingX:3;border:LR');
                
              }
            }else{
                if($i == ($personality->totalCareers($personality->personality_id)-1))
                 $table->easyCell("",'colspan:2;font-size:12;paddingY:2;paddingX:3;border:LRB');
                else
                 $table->easyCell("",'colspan:2;font-size:12;paddingY:2;paddingX:3;border:LR');
            }
          }
            $table->printRow();
        }

        $table->printRow();

        $table->endTable();
        $this->counsellorinfo($pdf,$table);
    }
    private function ordinal($number) {
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        if ((($number % 100) >= 11) && (($number%100) <= 13))
            return $number. 'th';
        else
            return $number. $ends[$number % 10];
    } 
    private function personality_name(){

    }
    private function get_dominant_personality($question_set_score_id){
        
        $dominant = DorminantPersonality::where(["question_setup_score_id"=>$question_set_score_id,"position"=>$this->data[0]])->orderBy("score","desc")->get();
        if($dominant->count())
            return array("personality_id"=>$dominant->first()->personality_id,"score"=>$dominant->first()->score,"personality_name"=>$dominant->first()->personality->name,"personality_success_message"=>$dominant->first()->personality->success_message);
        else
            return array("personality_id"=>"","score"=>"","personality_name"=>"","personality_success_message"=>"");
    }
    private function header($member,$table,$question_set_score,$pdf){
        $pdf->Ln(25);
        $table->rowStyle('align:{CCCC}; font-color:#000000; font-family:times;font-size:11; font-style:B;');
        
        $pdf->Image(public_path('images/tucee.jpg'),0,0,210);
        $table->easyCell('TUCEE PSYCHOMETRIC TEST','colspan:9;font-style:B;font-size:12;paddingX:3;border:0;');
        $table->printRow();
        $pdf->Ln(7);
        $table->rowStyle('align:{L}; font-color:#000000; font-family:times;font-size:12;');
        $table->easyCell('Name: ','colspan:2;paddingY:1;paddingX:3;border:0;');
        $table->easyCell(strtoupper($member->firstName.' '.$member->middleName.' '.$member->lastName),'colspan:6;paddingY:1;paddingX:3;border:B;');
        $table->easyCell('Age:','colspan:1;paddingY:1;paddingX:3;border:0;');
        $table->easyCell($question_set_score->first()->age.' yrs','colspan:2;paddingY:1;paddingX:3;border:B;');
        $table->printRow();
        $pdf->Ln(4);
        $table->rowStyle('align:{L}; font-color:#000000; font-family:times;font-size:12;');
        $table->easyCell('Place: ','colspan:2;paddingX:3;paddingY:1;border:0;');
        $table->easyCell($question_set_score->first()->institution->first()->name,'colspan:5;paddingY:1;paddingX:3;border:B;');
        $table->easyCell('Date: ','colspan:1;paddingY:1;paddingX:3;border:0;');
        $table->easyCell(date('M d, Y', strtotime($question_set_score->first()->created_at)),'colspan:6;paddingY:1;paddingX:3;border:B;');
        $table->printRow();
        $pdf->Ln(7);
    }
    private function counsellorinfo ($pdf){
        $pdf->Ln(14);
        $table=new easyTable($pdf, '{45, 55,25,25, 25,25}','align:C{CCCCCC};border:1; border-color:#000000; ');
        
        $table->rowStyle('align:{LLLCC}; font-color:#000000; font-family:times;font-size:11');
        $table->easyCell('Counsellor\'s Name:','colspan:1;paddingY:2;paddingX:3;border:TLR;');
        $table->easyCell('Cecilia Tutu-Danquah','colspan:2;paddingY:2;paddingX:3;border:TR;');
        $table->easyCell('Offical Stamp','colspan:3;font-style:B;paddingY:2;paddingX:3;border:TLR;');
        $table->printRow();
        $table->rowStyle('align:{LLLLL}; font-color:#000000; font-family:times;font-size:11;');
        $table->easyCell('Contact Number:','colspan:1;paddingY:2;paddingX:3; border:TBLR;');
        $table->easyCell('0244996991, 0541369429','colspan:2;paddingY:2;paddingX:3;border:TBLR;');
        $table->easyCell($pdf->Image(public_path('images/stamp.jpg'),145,$pdf->GetY(),40),'colspan:3;font-style:B;paddingY:2;paddingX:3;border:LR;');
        $table->printRow();
        $table->rowStyle('min-height:15;align:{LLLCC}; font-color:#000000; font-family:times;font-size:11;');
        $table->easyCell('Counsellor\'s Signature:','colspan:1;paddingY:2;paddingX:3;border:TBLR;');
        $table->easyCell('','colspan:2;paddingY:2;paddingX:3;border:TRB;');
        $table->easyCell($pdf->Image(public_path('images/signature.jpg'),60,$pdf->GetY()+1,40),'colspan:3;font-style:B;paddingY:2;paddingX:3;border: RB;');
        $table->printRow();
    }
    private function header2($member,$table,$question_set_score,$pdf){
        $pdf->Ln(25);
        $table->rowStyle('align:{CCCC}; font-color:#000000; font-family:times;font-size:11; font-style:B;');
        
        $pdf->Image(public_path('images/tucee.jpg'),0,0,310);
        $pdf->Ln(20);
        $table->easyCell('TUCEE PSYCHOMETRIC TEST','colspan:19;font-style:B;font-size:12;paddingX:3;border:0;');
        $table->printRow();
        $pdf->Ln(7);
        $table->rowStyle('align:{L}; font-color:#000000; font-family:times;font-size:12;');
        $table->easyCell('Name: ','colspan:2;paddingY:1;paddingX:3;border:0;');
        $table->easyCell(strtoupper($member->firstName.' '.$member->middleName.' '.$member->lastName),'colspan:12;paddingY:1;paddingX:3;border:B;');
        $table->easyCell('Age:','colspan:1;paddingY:1;paddingX:3;border:0;');
        $table->easyCell($question_set_score->first()->age.' yrs','colspan:2;paddingY:1;paddingX:3;border:B;');
        $table->printRow();
        $pdf->Ln(4);
        $table->rowStyle('align:{L}; font-color:#000000; font-family:times;font-size:12;');
        $table->easyCell('Place: ','colspan:2;paddingX:3;paddingY:1;border:0;');
        $table->easyCell($question_set_score->first()->institution->first()->name,'colspan:11;paddingY:1;paddingX:3;border:B;');
        $table->easyCell('Date: ','colspan:1;paddingY:1;paddingX:3;border:0;');
        $table->easyCell(date('M d, Y', strtotime($question_set_score->first()->created_at)),'colspan:6;paddingY:1;paddingX:3;border:B;');
        $table->printRow();
        $pdf->Ln(7);
    }
    private function personality_score_sheet($pdf,$member,$question_set_score,$question_setup){
        $total_personality = Personality::count() / 3;
        for($i=1; $i<=$total_personality;$i++){
            if($i==1){
                $position = 1;
                $personalities = Personality::orderBy("created_at","asc")->take(($i*3))->get();
            }else{
                $position = (3*3)+1;
                $personalities = Personality::orderBy("created_at","asc")->skip((($i-1)*3))->take(3)->get();
            }

            $this ->personality_table($pdf,$member,$personalities,$position,$question_set_score,$question_setup);
        }
    }
    private function personality_table($pdf,$member,$personalities,$position,$question_set_score,$question_setup){
        $table=new easyTable($pdf, '{25, 25,25,25, 25,25,25, 25,25,25, 25,25,25, 25,25,25, 25,25}','align:C{CCCCCCCCCCCCCCCCCC};border:1; border-color:#000000; ');
        if($position==1){
        $this ->header2($member,$table,$question_set_score,$pdf);
        $table->rowStyle('align:{CCCC}; font-color:#000000; font-family:times;font-size:11; font-style:B;');
        
        $table->easyCell('INTEREST SCORING SHEET','colspan:18;font-style:B;font-size:12;paddingX:3;border:0;');
        $table->printRow();
        $pdf->Ln(1);
    }

        foreach ($personalities as $personality) {
            $table->rowStyle('valign:M;align:{CCCCCCCCCCCCCC}; font-color:#000000; font-family:times;font-size:10; font-style:B;');
            $table->easyCell(strtoupper($personality->name),'valign:M;align:{CCC};colspan:6;font-style:B;font-size:15;paddingY:3;paddingX:3;');
        }
        $table->printRow();
        foreach ($personalities as $personality) {
            $table->rowStyle('valign:M;align:{CCCCCCCCCCCCCC}; font-color:#000000; font-family:times;font-size:11;');
            $table->easyCell($personality->related_programme,'colspan:6;font-size:12;paddingY:1;paddingX:3;');
        }
        $table->printRow();

        $psonality=0;
        for($i=0;$i < (count($personalities) * 3);$i++) {
            $table->rowStyle('align:{CCCCCCCCCCCCCCCCC}; font-color:#000000; font-family:times;font-size:11;');
            $table->easyCell(($psonality+$position),'colspan:2;font-size:12;paddingY:2;paddingX:3;');
            $psonality++;
        }
        $table->printRow();
        foreach ($personalities as $personality) {
            foreach($personality->career_paths as $career_paths){
                $table->rowStyle('align:{CCCCCCCCCCCCCC}; font-color:#000000; font-family:times;font-size:11;');
                $table->easyCell($career_paths->name,'colspan:2;font-size:12;paddingY:2;paddingX:3;');
            }
        }
        $table->printRow();
        $ques = 0;
        for($i=1; $i < ($question_setup->questions->count() / 9);$i++){
            foreach ($personalities as $personality) {
                foreach($personality->career_paths as $career_paths){
                    foreach($career_paths->get_questions($career_paths->id,$question_setup->id,($i-1)) as $questions){
                        $table->rowStyle('align:{CCCCCCCCCCCCCCCCCC}; font-color:#000000; font-family:times;font-size:11;');
                        $table->easyCell($questions->question_number,'font-size:12;paddingY:2;paddingX:3;');
                        $table->easyCell($questions->get_score($questions->id,$question_set_score->id),'font-size:12;font-style:B;bgcolor:#D3D3D3;paddingY:2;paddingX:3;');
                    }
                }
            }
            $table->printRow();
        }
        foreach ($personalities as $personality) {
            $career_index=0;
            foreach($personality->career_paths as $career_paths){
                    $table->rowStyle('align:{CCCCCCCCCCCCCC}; font-color:#000000; font-family:times;font-size:11;');
                    if($career_index==0)
                        $table->easyCell("Total\nScore",'font-size:11;paddingY:2;paddingX:3;border:LB');
                    else
                        $table->easyCell("",'font-size:11;paddingX:3;border:LB');
                    $table->easyCell($career_paths->career_path_score($career_paths->id,$question_set_score->id),'font-size:12;font-style:B;paddingY:2;paddingX:3;border:RB');
                $career_index++;
            }
        }
        $table->printRow();
        foreach ($personalities as $personality) {
            $table->rowStyle('align:{L}; font-color:#000000; font-family:times;font-size:11;');
            $table->easyCell("GRAND SCORE = ",'colspan:5;font-size:11;paddingY:2;paddingX:3;border:LB');
            $table->easyCell($personality->set_personality_score($personality->id,$question_set_score->id),'font-size:12;font-style:B;paddingY:2;paddingX:3;border:RB');
             
        }
        $table->printRow();
        $table->endTable();
        
        $pdf ->Ln(1);
    }
    private function load_questions($pdf,$questionset,$question_set_score,$table){
        
        $table->rowStyle('valign:M;align:{L};paddingY:2;paddingX:3;font-size:12');
        $table->easyCell('<b>S/N</b> ','colspan:1;border:TLBR;');
        $table->easyCell('<b>Question</b> ','colspan:4;border:TLBR;');
        $table->easyCell("<b>Strongly\nDislike</b>",';border:TBR;');
        $table->easyCell("<b>Dislike</b>",';border:TBR;');
        $table->easyCell("<b>Not \nSure</b> ",';border:TBR;');
        $table->easyCell("<b>Like</b> ",';border:TBR;');
        $table->easyCell("<b>Strongly \nLike</b>",';border:TBR;');
        $table->printRow();
        $index=0;
        foreach($questionset->questions as $question){
            $table->rowStyle('valign:M;align:{L};paddingY:2;paddingX:3;font-size:12');
            $table->easyCell($question->question_number,'colspan:1;border:TLB;');
            $table->easyCell($question->question,'colspan:4;border:TLBR;');
            if($question->get_score($question->id,$question_set_score->id) ==1){
                $table->easyCell("1",';border:TBR;font-style:B;bgcolor:#D3D3D3;');
            }else{
                $table->easyCell("1",';border:TBR;');
            }
            if($question->get_score($question->id,$question_set_score->id) ==2){
                $table->easyCell("2",';border:TBR;font-style:B;bgcolor:#D3D3D3;');
            }else{
                $table->easyCell("2",';border:TBR;');
            }
            if($question->get_score($question->id,$question_set_score->id) ==3){
                $table->easyCell("3",';border:TBR;font-style:B;bgcolor:#D3D3D3;');
            }else{
                $table->easyCell("3",';border:TBR;');
            }
            if($question->get_score($question->id,$question_set_score->id) ==4){
                $table->easyCell("4",';border:TBR;font-style:B;bgcolor:#D3D3D3;');
            }else{
                $table->easyCell("4",';border:TBR;');
            }
            if($question->get_score($question->id,$question_set_score->id) ==5){
                $table->easyCell("5",';border:TBR;font-style:B;bgcolor:#D3D3D3;');
            }else{
                $table->easyCell("5",';border:TBR;');
            }
        $table->printRow();
        }
        $table->endTable();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
