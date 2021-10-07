<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class capabilityPrimary extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'cpid';
    
    public function getSecondaryData(){
        return $this->hasMany('App\capabilitySecondary', 'cpid');
    }
}
