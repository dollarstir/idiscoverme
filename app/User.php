<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','firstName','middleName','lastName', 'staff_id','gender','title_id', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getGenderAttribute($attribute){
        return [
            0=>'Female',
            1=>'Male',
            3=>'Rather not to say'
        ][$attribute];
    }

    public function gender($gender){
        return ($gender == 1) ? 'Female' : 'Male';
    }

    public function user_contacts(){
        return $this->hasMany(UserContact::class);
    }

    public function user_email_addresses(){
        return $this ->hasMany(UserEmailAddress::class);
    }
}
