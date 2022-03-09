<?php

namespace App;
use App\MemberTerminal;
use Illuminate\Database\Eloquent\Model;

class LevelSubject extends Model
{
    public function level(){
        return $this->belongsTo(Level::class);
    }
    public function Subject(){
        return $this->belongsTo(Subject::class);
    }

    public function terminal_report_score($terminal_id,$subject_id){
        $terminal_report = MemberTerminal::where(["terminal_report_setup_id"=>$terminal_id,"subject_id"=>$subject_id])->get()->first();

        return $terminal_report;
    }
}
