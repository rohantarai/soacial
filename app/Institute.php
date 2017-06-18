<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    protected $table = 'institutes';
    protected $fillable = ['name'];
    
    public function programmes()
    {
        return $this->hasMany('App\Programme','institute_id','id');
    }

    public function users()
    {
        return $this->hasMany('App\User','id','institute');
    }
}