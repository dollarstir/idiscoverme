<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    //
    public function Terminal_report_setups(){
        return $this->hasMany(TerminalReportSetup::class);
    }

    public function levet_subjects(){
        return $this->hasMany(LevelSubject::class);
    }

    public function marking_schemes(){
        return $this->hasMany(MarkingScheme::class);
    }
}
