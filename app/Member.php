<?php

namespace App;
use DateTime;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $primaryKey = 'member_id';

    protected $fillable = [
        'member_id', 'firstName', 'middleName','lastName','gender','photo','dateOfBirth',
    ];
    public function getKeyType(){
        return 'string';
    }
    public function getRouteKeyName(){
        return 'member_id';
    }

    public function getGenderAttribute($attribute){
        return [
            0=>'Male',
            1=>'Female',
            3=>'Rather not to say'
        ][(int)$attribute];
    }

    public function member_guardian(){
        return $this ->hasMany(MemberGuardian::class);
    }

    public function token_keys(){
        return $this->hasMany(TokenKey::class);
    }
    public function getAge($ageDate){
       $birthDate = $ageDate;
  //explode the date to get month, day and year
  $birthDate = explode("-", $birthDate);
  //get age from date or birthdate
  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
    ? ((date("Y") - $birthDate[0]) - 1)
    : (date("Y") - $birthDate[0]));
    return $age;
    }

    private function filter_date($birthDate){
        $birthDate = explode("-", $birthDate);

        $birthDate = $birthDate[2].".".$birthDate[1].".".$birthDate[0];

        return $birthDate;
    }
}
