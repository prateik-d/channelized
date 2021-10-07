<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Syncevents extends Model
{
    protected $fillable = [
        'event_id', 'user_id', 'gsync', 'isync', 'osync'
    ];

    public $timestamps = false;
}
