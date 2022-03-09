<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarkingScheme extends Model
{
    protected $fillable = ["level_id","institution_institution_id","class_score","exams_score","status"];

    public function terminal_report_setups(){
        return $this->hasMany(TerminalReportSetup::class);
    }

    public function level(){
        return $this->belongsTo(Level::class);
    }
}
