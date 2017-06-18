<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $table = 'users';
    
    protected $fillable = ['reg_no','first_name','last_name','gender','institute','programme','email','password','plainPassword',
                            'confirm_password','verified','token','remember_token'];
    
    protected $hidden = ['reg_no','email','token','password','plainPassword','confirm_password','remember_token'];

    protected $appends = ['full_name'];
    

    public function usersInfo()
    {
        return $this->hasOne('App\UsersInfo','user_regno','reg_no');
    }

    public function institutes()
    {
        return $this->hasOne('App\Institute','id','institute');
    }

    public function programmes()
    {
        return $this->hasOne('App\Programme','id','programme');
    }

    public function interests()
    {
        return $this->belongsToMany('App\Interest','interest_user','user_id','interest_id');
    }

    public function pendingRequests()
    {
        return $this->belongsToMany('App\User','friend_user','user_id','friend_id')->wherePivot('approved',0)->withTimestamps();
    }

    public function approvedRequests()
    {
        return $this->belongsToMany('App\User','friend_user','friend_id','user_id')->wherePivot('approved',1)->withTimestamps();
    }

    function getFullNameAttribute() 
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    
    public function hasVerified()
    {
        $this->verified = true;
        $this->token = null;

        $this->save();
    }
    
}
