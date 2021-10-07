<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerFilter extends Model
{
    protected $fillable = [
        'user_id', 'category' , 'city_id', 'state_id', 'solution_id', 'industry_id', 'vendor_id', 'type_of_event_id','type_of_incentive_id','type_of_offer_id','type_of_technical_education_id','from_month','to_month'
    ];

    public function getCityName(){
        return $this->hasOne('App\City','id','city_id');
    }

    public function getStateName(){
        return $this->hasOne('App\State','id','state_id');
    }

    public function getSolutionName(){
        return $this->hasOne('App\Solution','id','solution_id');
    }

    public function getIndustryName(){
        return $this->hasOne('App\Industry','id','industry_id');
    }

    public function getVendorName(){
        return $this->hasOne('App\Vendor','id','vendor_id');
    }

    public function getType_of_eventName(){
        return $this->hasOne('App\Type_of_event','id','type_of_event_id');
    }
}
