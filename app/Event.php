<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Event extends Model
{
    protected $fillable = [
        'name', 'category', 'start_date', 'end_date', 'start_duration', 'end_duration', 'summary', 'short_summary', 'organised_by', 'registration_link', 'declared', 'added_by', 'user_timezone', 'status', 'solution_id', 'industry_id', 'type_of_event_id','type_of_incentive_id', 'type_of_offer_id', 'type_of_technical_education_id', 'timezone', 'logo', 'banner', 'event_type'
    ];
    
    public function eventagendas(){
        return $this->hasMany('App\EventAgenda');
    }

    public function eventlocations(){
        return $this->hasMany('App\EventLocation');
    }
    
    public function getStatusviewAttribute(){
        $sts = '';
        switch($this->status){
            case "in_review":
                $sts = "<b class='text-warning'>In review</b>";
                break;
            case "draft":
                $sts = "<b class='text-info'>Draft</b>";
                break;
            case "approved":
                $sts = "<b class='text-success'>Approved</b>";
                break;
            case "rejected":
                $sts = "<b class='text-danger'>Rejected</b>";
                break;
            default:
                $sts = "<b>".$this->status."</b>";
                break;
        }
        return $sts;
    }
    
    public function eventShortlisted(){
        return $this->hasOne('App\PartnerEventCount')->where('short_list',1)->where('user_id',Auth::user()->id);
    }
}
