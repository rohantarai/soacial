<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $table = 'interests';
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany('App\User','interest_user','interest_id','user_id');
    }
}
