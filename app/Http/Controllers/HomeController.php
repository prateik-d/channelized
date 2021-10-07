<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Event;
use Helper;
use App\capabilitySecondary;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        return view('home');
        if (Auth::user()->roles[0]->name == "admin"){
            return redirect('admin/events');
        } else if (Auth::user()->roles[0]->name == "partner"){
            return redirect('partner/home');
        } else {
            return redirect('vendor/home');
        }
    }
    
    public function admin(){
        dd('Admin Home');
    }
    
    public function partner(){
        $events = Helper::get_active_events()->count();
        $filter_events_count = 0;

        $partner_filter = Auth::user()->getPartnerFilter()->where('category','event')->first();
        if($partner_filter){
            $filter_events_count = Helper::get_filtered_events($partner_filter,'event')->count();
        }
        //dd($filter_events_count);
        $shortlisted_events = Helper::get_shortlisted_events('event');


        $rewards_incentives =  Helper::get_active_rewards_incentives()->count();
        $filter_rewards_incentives_count = 0;

        $rewards_incentives_partner_filter = Auth::user()->getPartnerFilter()->where('category','reward_incentive')->first();
        if($rewards_incentives_partner_filter){
            $filter_rewards_incentives_count = Helper::get_filtered_events($rewards_incentives_partner_filter,'reward_incentive')->count();
        }

        $offers = Helper::get_active_product_promotion_offer()->count();
        $filter_offers_count = 0;

        $offer_partner_filter = Auth::user()->getPartnerFilter()->where('category','product_promotion_offer')->first();
        if($offer_partner_filter){
            $filter_offers_count = Helper::get_filtered_events($offer_partner_filter, 'product_promotion_offer')->count();
        }


        $technical_education = Helper::get_active_technical_education()->count();
        $filter_technical_education_count = 0;

        $technical_education_partner_filter = Auth::user()->getPartnerFilter()->where('category','technical_education')->first();
        if($technical_education_partner_filter){
            $filter_technical_education_count = Helper::get_filtered_events($technical_education_partner_filter, 'technical_education')->count();
        }

        /* print_r($events);
        print_r($filter_events);
        exit(); */
        return view('partner.home', compact('events','filter_events_count','rewards_incentives','filter_rewards_incentives_count','offers','filter_offers_count', 'technical_education', 'filter_technical_education_count','shortlisted_events'));
    }
    
    public function vendor(){
        $events = Helper::get_active_events()->where('added_by',Auth::user()->id);
        $rewards_incentives =  Helper::get_active_rewards_incentives()->where('added_by',Auth::user()->id)->count();
        $offers = Helper::get_active_product_promotion_offer()->where('added_by',Auth::user()->id)->count();
        $technical_education = Helper::get_active_technical_education()->where('added_by',Auth::user()->id)->count();
        
        return view('vendor.home', compact('events','rewards_incentives','offers','technical_education'));
    }

    public function secondary_data(Request $request){
        $secondary_data = capabilitySecondary::whereIn('cpid', $request->cpid)->get();
        if($secondary_data){
            echo json_encode($secondary_data);
            exit;
        }
        echo json_encode([]);
        exit;
    }
}
