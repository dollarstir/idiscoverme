<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TerminalReportSetup extends Model
{
    protected $fillable = ["question_setup_score_id","level_id","marking_scheme_id","member_member_id","term","class_name_id","institution_institution_id"];

    public function level(){
        return $this->belongsTo(Level::class);
    }

    public function marking_scheme(){
        return $this->belongsTo(MarkingScheme::class);
    }

    public function member_terminals(){
        return $this->hasMany(MemberTerminal::class);
    }
}
