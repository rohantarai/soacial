<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    protected $table = 'programmes';
    protected $fillable = ['name','institute_id'];

    public function institutes()
    {
        return $this->belongsTo('App\Institute','institute_id','id');
    }

    public function users()
    {
        return $this->hasMany('App\User','id','programme');
    }
}
