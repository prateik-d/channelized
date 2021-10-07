<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerEventCount extends Model
{
    protected $fillable = [
        'user_id', 'event_id', 'read_more', 'short_list', 'view', 'user_ip'
    ];

    public function getEvents(){
        return $this->hasOne('App\Event','id','event_id')->where('category','event');
    }   
}
