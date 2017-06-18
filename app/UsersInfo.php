<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersInfo extends Model
{
    protected $table = 'usersinfo';
    
    protected $fillable = ['user_regno','academicYear_from','academicYear_to','high_school','current_city','hometown',
        'born_day','born_month','born_year','relationship','quotes','interests','achievements','about','avatar','loggedIn','ipAddress',
        'facebook','googleplus','instagram','linkedin','skype','snapchat','telegram','twitter','whatsapp','youtube','quora'];
    
    //this property hides the information from the HTTP interceptor tools like "Wireshark"
    protected $hidden = ['user_regno','academicYear_from','academicYear_to','high_school','current_city','hometown',
        'born_day','born_month','born_year','relationship','quotes','interests','achievements','about','avatar','loggedIn','ipAddress',
        'facebook','googleplus','instagram','linkedin','skype','snapchat','telegram','twitter','whatsapp','youtube','quora'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function users()
    {
        return $this->belongsTo('App\User','user_regno','reg_no');
    }

    public function setHighSchoolAttribute($value)
    {
        $this->attributes['high_school'] = $value ?: null;
    }
    
    public function setCurrentCityAttribute($value)
    {
        $this->attributes['current_city'] = $value ?: null;
    }

    public function setHometownAttribute($value)
    {
        $this->attributes['hometown'] = $value ?: null;
    }

    public function setBornYearAttribute($value)
    {
        $this->attributes['born_year'] = $value ?: null;
    }

    public function setRelationshipAttribute($value)
    {
        $this->attributes['relationship'] = $value ?: null;
    }

    public function setQuotesAttribute($value)
    {
        $this->attributes['quotes'] = $value ?: null;
    }

    public function setInterestsAttribute($value)
    {
        $this->attributes['interests'] = $value ?: null;
    }

    public function setAchievementsAttribute($value)
    {
        $this->attributes['achievements'] = $value ?: null;
    }

    public function setAboutAttribute($value)
    {
        $this->attributes['about'] = $value ?: null;
    }

    public function setFacebookAttribute($value)
    {
        $this->attributes['facebook'] = $value ?: null;
    }

    public function setGoogleplusAttribute($value)
    {
        $this->attributes['googleplus'] = $value ?: null;
    }

    public function setInstagramAttribute($value)
    {
        $this->attributes['instagram'] = $value ?: null;
    }

    public function setLinkedinAttribute($value)
    {
        $this->attributes['linkedin'] = $value ?: null;
    }

    public function setSkypeAttribute($value)
    {
        $this->attributes['skype'] = $value ?: null;
    }

    public function setSnapchatAttribute($value)
    {
        $this->attributes['snapchat'] = $value ?: null;
    }

    public function setTelegramAttribute($value)
    {
        $this->attributes['telegram'] = $value ?: null;
    }

    public function setTwitterAttribute($value)
    {
        $this->attributes['twitter'] = $value ?: null;
    }

    public function setWhatsappAttribute($value)
    {
        $this->attributes['whatsapp'] = $value ?: null;
    }

    public function setYoutubeAttribute($value)
    {
        $this->attributes['youtube'] = $value ?: null;
    }

    public function setQuoraAttribute($value)
    {
        $this->attributes['quora'] = $value ?: null;
    }
}
