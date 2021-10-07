<?php

namespace App\Helpers;

use App\Event;

class Helper{
    public static function get_shortlisted_events($category){
        return Event::where('is_deleted',0)->where('category', $category)->where('status','approved')->Has('eventShortlisted')->get();
    }

    public static function get_filtered_events($partner_filter,$category = ''){
        $query = Event::query();
        if(isset($partner_filter->city_id) && $partner_filter->city_id || isset($partner_filter->state_id) && $partner_filter->state_id){
            $query = $query->WhereHas('eventlocations', function($q) use ($partner_filter) {
                if(isset($partner_filter->city_id) && $partner_filter->city_id){
                    $q->where('city_id', $partner_filter->city_id);
                }
                
                if(isset($partner_filter->state_id) && $partner_filter->state_id){
                    $q->Where('state_id', $partner_filter->state_id);
                }
            });
        }
        if(isset($partner_filter->solution_id) && $partner_filter->solution_id){
            $query = $query->where('solution_id',$partner_filter->solution_id);
        }
        if(isset($partner_filter->industry_id) && $partner_filter->industry_id){
            $query = $query->where('industry_id',$partner_filter->industry_id);
        }
        if(isset($partner_filter->type_of_event_id) && $partner_filter->type_of_event_id){
            $query = $query->where('type_of_event_id',$partner_filter->type_of_event_id);
        }
        if(isset($partner_filter->type_of_incentive_id) && $partner_filter->type_of_incentive_id){
            $query = $query->where('type_of_incentive_id',$partner_filter->type_of_incentive_id);
        }
        if(isset($partner_filter->type_of_offer_id) && $partner_filter->type_of_offer_id){
            $query = $query->where('type_of_offer_id',$partner_filter->type_of_offer_id);
        }
        if(isset($partner_filter->type_of_technical_education_id) && $partner_filter->type_of_technical_education_id){
            $query = $query->where('type_of_technical_education_id',$partner_filter->type_of_technical_education_id);
        }
        if(isset($partner_filter->to_month) && $partner_filter->to_month){
            $st = $partner_filter->to_month;
            $ed = $partner_filter->from_month;
            
            $query = $query->where(function($que) use ($st, $ed){
                $que->wherebetween('start_date', [$st, $ed])
                      ->orwherebetween('end_date', [$st, $ed]);
            });
        }
        $events = $query->where('is_deleted',0)
                        ->where('status','approved')
                        ->where('category',$category)
                        ->get();
        return $events;
    }

    public static function get_events(){
        return Event::where('is_deleted',0)->where('category','event')->get();
    }

    public static function get_active_events(){
        return Event::where('is_deleted',0)
                        /* ->whereNotIn('status',['draft','rejected']) */
                        ->where('status','approved')
                        ->where('category','event')
                        ->get();
    }
    public static function get_active_rewards_incentives(){
        return Event::where('is_deleted',0)
                        /* ->whereNotIn('status',['draft','rejected']) */
                        ->where('status','approved')
                        ->where('category','reward_incentive')
                        ->get();
    }
    public static function get_active_product_promotion_offer(){
        return Event::where('is_deleted',0)
                        /* ->whereNotIn('status',['draft','rejected']) */
                        ->where('status','approved')
                        ->where('category','product_promotion_offer')
                        ->get();
    }
    public static function get_active_technical_education(){
        return Event::where('is_deleted',0)
                        /* ->whereNotIn('status',['draft','rejected']) */
                        ->where('status','approved')
                        ->where('category','technical_education')
                        ->get();   
    }

    public static function search_active_events($txt){
        return Event::where('is_deleted',0)
                        /* ->whereNotIn('status',['draft','rejected']) */
                        ->where('status','approved')
                        //->where('category','event')
                        ->where(function($query) use ($txt){
                            $query->where('name', 'LIKE', '%'.$txt.'%')
                                ->orWhere('summary', 'LIKE', '%'.$txt.'%');
                        })
                        ->get();
    }

    public static function get_home_page_events($type){
        return Event::where('is_deleted',0)
                    ->where('status','approved')
                    ->where('category',$type)
                    ->take(3)
                    ->latest()
                    ->get();
    }
}

?>