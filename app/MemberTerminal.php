<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberTerminal extends Model
{
    protected $fillable = ["terminal_report_setup_id","subject_id","class_score","exams_score","total","position"];

    public function termal_report_setup(){
        return $this->belongsTo(TerminalReportSetup::class);
    }
}
