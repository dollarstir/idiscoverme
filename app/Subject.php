<?php

namespace App;
use App\MemberTerminal;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    
    public function level_subjects(){
        return $this->hasMany(LevelSubject::class);
    }

    public function terminal_report_score($terminal_id,$subject_id){
        $terminal_report = MemberTerminal::where(["terminal_report_setup_id"=>$terminal_id,"subject_id"=>$subject_id])->get()->first();

        return $terminal_report;
    }
}
