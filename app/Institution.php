<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
   

    protected $fillable = ['id','name','institution_id','POBox','logo','district_id','institution_type_id','GPS_address'];
     
    protected $primaryKey = 'institution_id';

    public function getKeyType(){
        return 'string';
    }
    public function getRouteKeyName(){
        return 'institution_id';
    }


    public function institution_type(){
        return $this->belongsTo(InstitutionType::class);
    }

    public function institution_contacts(){
        return $this ->hasMany(InstitutionContact::class);
    }
    public function institution_addresses(){
        return $this ->hasMany(InstitutionContact::class);
    }
    public function question_setup_scores(){
        return $this ->hasMany(QuestionSetupScore::class);
    }
    public function district(){
        return $this->belongsTo(District::class);
    }

    public function member_instutitons(){
        return $this->hasMany(MemberInstitution::class);
    }
    
}
