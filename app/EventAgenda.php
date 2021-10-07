<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventAgenda extends Model
{
    protected $table = "event_agendas";
    
    protected $fillable = ['start', 'end', 'topic', 'speaker_name', 'event_id'];
    
    public function events(){
        return $this->belongsTo('App\Event')->where('category','event');
    }
}
