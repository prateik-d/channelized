<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventLocation extends Model
{
    protected $table = "event_locations";
    
    protected $fillable = ['location', 'city_id', 'state_id', 'post_code', 'event_id'];
    
    public function events(){
        return $this->belongsTo('App\Event')->where('category','event');
    }

    public function eventLocationCity(){
        return $this->hasOne('App\City', 'id', 'city_id');
    }
    public function eventLocationState(){
        return $this->hasOne('App\State', 'id', 'state_id');
    }
}
