<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Auth, Crypt, DB, stdClass;
use App\User;
use App\City;
use App\State;
use App\Solution;
//use App\Industry;
use App\Vendor;
//use App\Type_of_event;
use App\Type_of_incentive;
use App\PartnerFilter;
use App\PartnerEventCount;
use Carbon\Carbon;
use App\Jobcategory;
use App\Businesstype;
use Helper, DateTime;

class RewardsIncentivesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $events = Auth::user()->getUserEvents('reward_incentive')->get();
        
        $ecounts = DB::select('SELECT e.id as eid, e.name as name, e.start_date as start_date, e.end_date as end_date, sum(if(user_id != 0,read_more,0)) as impression FROM `partner_event_counts` RIGHT JOIN events as e on e.id = partner_event_counts.event_id where e.added_by='.Auth::user()->id.' and e.status="approved" and e.category="reward_incentive" and e.is_deleted = "0" GROUP by event_id');

        return view('vendor.reward_incentives', compact('events','ecounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($etype = 'multiple')
    {
        $cities = City::get();
        $states = State::get();
        $solutions = Solution::get();
        //$industries = Industry::get();
        $vendors = Vendor::get();
        $type_of_events = Type_of_incentive::get();
        return view('reward_incentive.create', compact('etype','cities', 'states', 'solutions','vendors','type_of_events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->status!="draft"){
            $this->validate($request, [
                'name' => 'required|unique:events,name,NULL,id,category,reward_incentive,is_deleted,0',
                //'location.*' => 'required',
                //'city.*' => 'required|numeric',
                //'state.*' => 'required|numeric',
                'post_code.*' => 'required|numeric',
                'stdt' => 'required|date_format:Y-m-d|before_or_equal:etdt',
                'etdt' => 'required|date_format:Y-m-d',
                'stdu' => 'required|date_format:h:i A',
                'etdu' => 'required|date_format:h:i A',
                'time_zone' => 'required',
                'solution' => 'required|numeric',
                //'industry' => 'required|numeric',
                'type' => 'required|numeric',
                //'size' => 'required',
                'summary' => 'required|max:350',
                'short_summary' => 'required|max:150',
                'organised' => 'required',
                //'registration' => 'nullable|url',
                //'declare' => 'accepted',
                'tz' => 'required',
                //'agdst.*' => 'required|date_format:h:i A', //|required_with:agdet.*,topic.*,spkrnm.*
               // 'agdet.*' => 'required|date_format:h:i A', //|required_with:agdst.*,topic.*,spkrnm.*
               // "topic.*" => "required|string", //|required_with:agdst.*,agdet.*,spkrnm.*
               // "spkrnm.*" => "required|string", //|required_with:agdst.*,topic.*,agdet.*
                'logo' => 'required|image|mimes:jpeg,png,jpg,eps|max:2048',
                'banner' => 'required|image|mimes:jpeg,png,jpg,eps|max:2048',
            ],[
                'stdt.required' => 'The start date field is required.',
                'stdt.date_format' => 'The start date does not match the format Y-m-d.',
                'etdt.required' => 'The end date field is required.',
                'etdt.date_format' => 'The end date does not match the format Y-m-d.',
                'stdu.required' => 'The start duration field is required.',
                'stdu.date_format' => 'The start duration does not match the format H:m',
                'etdu.required' => 'The end duration field is required.',
                'etdu.date_format' => 'The end duration does not match the format H:m',
               // 'agdst.*' => 'The Agenda start does not match the format H:m',
               // 'agdet.*' => 'The Agenda end does not match the format H:m',
               // 'topic.*' => 'The Agenda topic must be string.',
               // 'spkrnm.*' => 'The Agenda speaker must be string.',
                'location.*' => 'The location field is required.',
               // 'city.*' => 'The city field is required.',
               // 'state.*' => 'The state field is required.',
               // 'post_code.*' => 'The post code field is required.',
            ]);
        }else{
            $this->validate($request, [
                'name' => 'required|unique:events,name'
            ]);
        }

        $data = $request->all();
        
        /* echo '<pre>';
        print_r($data);
        exit; */
        
        $destinationPath = public_path('uploads/events');
        $logo=null;
        if($request->hasFile('logo')){
            $logofile = $request->file('logo');
            $logo = time().'-logo.'.$logofile->getClientOriginalExtension();
            //Move Uploaded File
            $logofile->move($destinationPath, $logo);
        }
        
        $banner=null;
        if($request->hasFile('banner')){
            $bannerfile = $request->file('banner');
            $banner = time().'-banner.'.$bannerfile->getClientOriginalExtension();
            //Move Uploaded File
            $bannerfile->move($destinationPath, $banner);
        }

        $stdu = '00:00';
        if($data['stdu']){
            $stdu = new DateTime($data['stdu']);
            $stdu = $stdu->format('H:i');
        }

        $etdu = '00:00';
        if($data['etdu']){
            $etdu = new DateTime($data['etdu']);
            $etdu = $etdu->format('H:i');
        }
        
        if(isset($data['declare'])){
            $data['declare'] = true;
        }else{
            $data['declare'] = false;
        }
        
        $fields = [
            'name' => $data['name'],
            'category' => 'reward_incentive',
            'start_date' => $data['stdt'],
            'end_date' => $data['etdt'],
            'start_duration' => $stdu,
            'end_duration' => $etdu,
            /* 'size' => $data['size'], */
            'summary' => $data['summary'],
            'short_summary' => $data['short_summary'],
            'organised_by' => $data['organised'],
           //'registration_link' => (!empty($data['registration'])?$data['registration']:null),
            /* 'target_audiance' => $data['target'], */
            'declared' => $data['declare'],
            'added_by' => Auth::user()->id,
            'user_timezone' => $data['tz'],
            'timezone' => $data['time_zone'],
            'solution_id' => $data['solution'],
           // 'industry_id' => $data['industry'],
            'type_of_incentive_id' => $data['type'],
            'logo' =>  $logo,
            'banner' =>  $banner,
            'event_type' => $data['event_type'],
        ];
        
        if(isset($data['status'])){
            $fields['status'] = $data['status'];
        }

        $locations_fields = [];
        foreach($data['location'] as $i=>$val){

            $city =  City::where('name', $data['city'][$i])->first();
            if($city){
                $city_id = $city->id;
            }else{
                $city_array = [
                    'name' => $data['city'][$i] 
                ];

               $insert_city = City::create($city_array);

               $city_id = $insert_city->id;
            }

            $state =  State::where('name', 'like', $data['state'][$i].'%')->first();
            if($state){
                $state_id = $state->id;
            }else{
                $state_array = [
                    'name' => $data['state'][$i] 
                ];

               $insert_state = State::create($state_array);

               $state_id = $insert_state->id;
            }


            $locations_fields[$i] = array(
                'location' => $data['location'][$i],
                'city_id' => $city_id,
                'state_id' => $state_id,
                'post_code' => $data['post_code'][$i]
            );
        }
        
        // $agenda_fields = [];
        // foreach($data['agdst'] as $i => $val){
        //     $fagdst = '00:00';
        //     if($data['agdst'][$i]){
        //         $astdu = new DateTime($data['agdst'][$i]);
        //         $fagdst = $astdu->format('H:i');
        //     }

        //     $fagdet = '00:00';
        //     if($data['agdet'][$i]){
        //         $aetdu = new DateTime($data['agdet'][$i]);
        //         $fagdet = $aetdu->format('H:i');
        //     }

        //     $agenda_fields[$i]['start'] = $fagdst;
        //     $agenda_fields[$i]['end'] = $fagdet;
        //     $agenda_fields[$i]['topic'] = $data['topic'][$i];
        //     $agenda_fields[$i]['speaker_name'] = $data['spkrnm'][$i];
        // }

        /* echo '<pre>';
        print_r($fields);
        print_r($locations_fields);
        print_r($agenda_fields);
        exit; */

        $event = Event::create($fields);
        
        $event->eventlocations()->createMany($locations_fields);
        //$event->eventagendas()->createMany($agenda_fields);
        
        /* return redirect(Auth::user()->roles[0]->name.'/evnets')->with('success','event added successfully.'); */
        return redirect(Auth::user()->roles[0]->name.'/event_success/reward_incentive');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $event = Event::find($id);
        $cities = City::get();
        $states = State::get();
        $solutions = Solution::get();
        //$industries = Industry::get();
        $vendors = Vendor::get();
        $type_of_events = Type_of_incentive::get();

        return view('reward_incentive.edit', compact('event', 'cities', 'states', 'solutions', 'vendors','type_of_events'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        
        if($request->status!="draft"){
            $this->validate($request, [
                'name' => 'required|unique:events,name,'.$id.',id,category,reward_incentive,is_deleted,0',
                'location.*' => 'required',
                //'city.*' => 'required|numeric',
                //'state.*' => 'required|numeric',
                //'post_code.*' => 'required|numeric',
                'stdt' => 'required|date_format:Y-m-d|before_or_equal:etdt',
                'etdt' => 'required|date_format:Y-m-d',
                'stdu' => 'required|date_format:h:i A',
                'etdu' => 'required|date_format:h:i A',
                'time_zone' => 'required',
                'solution' => 'required|numeric',
                //'industry' => 'required|numeric',
                'type' => 'required|numeric',
                //'size' => 'required',
                'summary' => 'required|max:350',
                'short_summary' => 'required|max:150',
                'organised' => 'required',
                //'registration' => 'nullable|url',
                //'declare' => 'accepted',
                'tz' => 'required',
                //'agdst.*' => 'required|date_format:h:i A', //|required_with:agdet.*,topic.*,spkrnm.*
               // 'agdet.*' => 'required|date_format:h:i A', //|required_with:agdst.*,topic.*,spkrnm.*
               // "topic.*" => "required|string", //|required_with:agdst.*,agdet.*,spkrnm.*
               // "spkrnm.*" => "required|string", //|required_with:agdst.*,topic.*,agdet.*
                'logo' => 'image|mimes:jpeg,png,jpg,eps|max:2048',
                'banner' => 'image|mimes:jpeg,png,jpg,eps|max:2048',
            ],[
                'stdt.required' => 'The start date field is required.',
                'stdt.date_format' => 'The start date does not match the format Y-m-d.',
                'etdt.required' => 'The end date field is required.',
                'etdt.date_format' => 'The end date does not match the format Y-m-d.',
                'stdu.required' => 'The start duration field is required.',
                'stdu.date_format' => 'The start duration does not match the format H:m',
                'etdu.required' => 'The end duration field is required.',
                'etdu.date_format' => 'The end duration does not match the format H:m',
               // 'agdst.*' => 'The Agenda start does not match the format H:m',
               // 'agdet.*' => 'The Agenda end does not match the format H:m',
               // 'topic.*' => 'The Agenda topic must be string.',
               // 'spkrnm.*' => 'The Agenda speaker must be string.',
                'location.*' => 'The location field is required.',
                //'city.*' => 'The city field is required.',
                //'state.*' => 'The state field is required.',
                //'post_code.*' => 'The post code field is required.',
            ]);
        }else{
            $this->validate($request, [
                'name' => 'required|unique:events,name' .$id,
            ]);
        }

        $data = $request->all();
        
        /* echo '<pre>';
        print_r($data);
        exit; */
        
        $destinationPath = public_path('uploads/events');
        
        if($request->hasFile('logo')){
            $logofile = $request->file('logo');
            $logo = time().'-logo.'.$logofile->getClientOriginalExtension();
            //Move Uploaded File
            $logofile->move($destinationPath, $logo);
        }
        
       
        if($request->hasFile('banner')){
            $bannerfile = $request->file('banner');
            $banner = time().'-banner.'.$bannerfile->getClientOriginalExtension();
            //Move Uploaded File
            $bannerfile->move($destinationPath, $banner);
        }

        $stdu = '00:00';
        if($data['stdu']){
            $stdu = new DateTime($data['stdu']);
            $stdu = $stdu->format('H:i');
        }

        $etdu = '00:00';
        if($data['etdu']){
            $etdu = new DateTime($data['etdu']);
            $etdu = $etdu->format('H:i');
        }
        
       if(!isset($data['category'])){
            $data['category'] = 'reward_incentive';
        }
        
        $fields = [
            'name' => $data['name'],
            'category' => $data['category'],
            'start_date' => $data['stdt'],
            'end_date' => $data['etdt'],
            'start_duration' => $stdu,
            'end_duration' => $etdu,
            /* 'size' => $data['size'], */
            'summary' => $data['summary'],
            'short_summary' => $data['short_summary'],
            'organised_by' => $data['organised'],
           //'registration_link' => (!empty($data['registration'])?$data['registration']:null),
            /* 'target_audiance' => $data['target'], */
            //'declared' => $data['declare'],
            //'added_by' => Auth::user()->id,
           // 'user_timezone' => $data['tz'],
            'timezone' => $data['time_zone'],
            'solution_id' => $data['solution'],
           // 'industry_id' => $data['industry'],
            'type_of_incentive_id' => $data['type'],
            //'logo' =>  $logo,
           // 'banner' =>  $banner,
            //'event_type' => $data['event_type'],
        ];

        if($request->logo){
            $fields['logo'] = $logo;
        }

        if($request->banner){
            $fields['banner'] = $banner;
        }

        if(isset($data['status'])){
            $fields['status'] = $data['status'];
        }else{
            $fields['status'] = 'in_review';
        }
        

        $locations_fields = [];
        foreach($data['location'] as $i=>$val){
            $city =  City::where('name', $data['city'][$i])->first();
            if($city){
                $city_id = $city->id;
            }else{
                $city_array = [
                    'name' => $data['city'][$i] 
                ];

               $insert_city = City::create($city_array);

               $city_id = $insert_city->id;
            }

            $state =  State::where('name', 'like', $data['state'][$i].'%')->first();
            if($state){
                $state_id = $state->id;
            }else{
                $state_array = [
                    'name' => $data['state'][$i] 
                ];
               $insert_state = State::create($state_array);

               $state_id = $insert_state->id;
            }


            $locations_fields[$i] = array(
                'location' => $data['location'][$i],
                'city_id' => $city_id,
                'state_id' => $state_id,
                'post_code' => $data['post_code'][$i]
            );
        }
        
        // $agenda_fields = [];
        // foreach($data['agdst'] as $i => $val){
        //     $fagdst = '00:00';
        //     if($data['agdst'][$i]){
        //         $astdu = new DateTime($data['agdst'][$i]);
        //         $fagdst = $astdu->format('H:i');
        //     }

        //     $fagdet = '00:00';
        //     if($data['agdet'][$i]){
        //         $aetdu = new DateTime($data['agdet'][$i]);
        //         $fagdet = $aetdu->format('H:i');
        //     }

        //     $agenda_fields[$i]['start'] = $fagdst;
        //     $agenda_fields[$i]['end'] = $fagdet;
        //     $agenda_fields[$i]['topic'] = $data['topic'][$i];
        //     $agenda_fields[$i]['speaker_name'] = $data['spkrnm'][$i];
        // }

        /* echo '<pre>';
        print_r($fields);
        print_r($locations_fields);
        print_r($agenda_fields);
        exit; */

        $eventres = Event::where('id', $id)->update($fields);

        $event = Event::find($id);

        $event->eventlocations()->delete();
        $event->eventlocations()->createMany($locations_fields);
        
        //$event->eventagendas()->createMany($agenda_fields);
        
        /* return redirect(Auth::user()->roles[0]->name.'/evnets')->with('success','event added successfully.'); */
        return redirect(Auth::user()->roles[0]->name.'/rewards-incentives')->with('success','event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function partner_rewards_incentives(Request $request){
        
        //dd($request->method());
        /* if ($request->isMethod('post')) {
            dd($request->all());
        } */
        $cities = City::get();
        $states = State::get();
        $solutions = Solution::get();
       // $industries = Industry::get();
        $vendors = Vendor::get();
        $type_of_incentives = Type_of_incentive::get();
        $partner_filter = Auth::user()->getPartnerFilter()->where('category','reward_incentive')->first();
        $filter_events_count = 0;
        $txt = null;
        if($request->search_event){
            $txt = $request->search_event;
            $events = Helper::search_active_events($txt);
        }elseif($partner_filter){
            /* DB::enableQueryLog(); */
            /* $events = Event::where('is_deleted',0)
                        ->where('solution_id',$partner_filter->solution_id)
                        ->orWhere('industry_id',$partner_filter->industry_id)
                        ->orWhere('type_of_event_id',$partner_filter->type_of_event_id)
                        ->orWhereHas('eventlocations', function($query) use ($partner_filter) {
                            $query->where('city_id', $partner_filter->city_id)
                                ->orWhere('state_id', $partner_filter->state_id);
                        })
                        ->orHas('eventShortlisted')
                        ->get(); */

            $events =Helper::get_filtered_events($partner_filter,'reward_incentive');
            $filter_events_count = $events->count();
           /*  $qu = DB::getQueryLog();
            print_r($qu);
            exit(); */
        }else{
            $events = Helper::get_active_rewards_incentives();
        }
        
       /*  echo '<pre>'; */
        /* print_r($partner_filter); */
        /* exit;
        echo '<pre>'; */
        /* foreach ($events as $event){
            print_r($event);
            print_r(($event->eventShortlisted ? $event->eventShortlisted->short_list : 0));
        }
        exit; */
        return view('reward_incentive.partner', compact('cities','states','solutions','vendors','type_of_incentives','partner_filter','events','txt','filter_events_count'));
    }

    public function partner_filter_store(Request $request){

        //dd($request->all());

        $this->validate($request, [
            'city' => 'required_without_all:state,solution,vendor,type_of_incentive,month',
            'state' => 'required_without_all:city,solution,vendor,type_of_incentive,month',
            'solution' => 'required_without_all:state,city,vendor,type_of_incentive,month',
           // 'industry' => 'required_without_all:state,solution,city,vendor,type_of_event,month',
            'vendor' => 'required_without_all:state,solution,city,type_of_incentive,month',
            'type_of_incentive' => 'required_without_all:state,solution,vendor,city,month',
            'month' => 'required_without_all:state,solution,vendor,city,type_of_incentive'
        ]);
        
        $data = $request->all();
        
        $fields = [];
        if(isset($data['city'])){
            $fields['city_id'] = $data['city'];
        }
        if(isset($data['state'])){
            $fields['state_id'] = $data['state'];
        }
        if(isset($data['solution'])){
            $fields['solution_id'] = $data['solution'];
        }
        // if(isset($data['industry'])){
        //     $fields['industry_id'] = $data['industry'];
        // }
        if(isset($data['vendor'])){
            $fields['vendor_id'] = $data['vendor'];
        }
        if(isset($data['type_of_incentive'])){
            $fields['type_of_incentive_id'] = $data['type_of_incentive'];
        }
        if(isset($data['month'])){
            $rang = explode('-',$data['month']);
            $to = Carbon::parse($rang[0])->format('Y-m-d'); 
            $from = Carbon::parse($rang[1])->format('Y-m-d');
            
            $fields['from_month'] = $from;
            $fields['to_month'] = $to;
        }
        $fields['user_id'] = Auth::user()->id;
        $fields['category'] = 'reward_incentive';

        $partner_filter = PartnerFilter::updateOrCreate(['user_id'=>Auth::user()->id,'category'=>'reward_incentive'],$fields);
        
        if($partner_filter){
            return back()->with('success','Filter added successfully.');
        }
        return back()->with('error','Something issue in filter.');
    }

    public function partner_rewards_incentives_filter(Request $request){
        /* echo '<pre>';
        print_r($request->all());
        exit(); */
        
        $partner_filter = Auth::user()->getPartnerFilter()->where('category','reward_incentive')->first();
        if(empty($partner_filter)){
            $partner_filter= new stdClass();
        }

        $data = $request->all();
        if(isset($data['filter']['city'])){
            $partner_filter->city_id = $data['filter']['city'];
        }
        if(isset($data['filter']['state'])){
            $partner_filter->state_id = $data['filter']['state'];
        }
        if(isset($data['filter']['solution'])){
            $partner_filter->solution_id = $data['filter']['solution'];
        }
        // if(isset($data['filter']['industry'])){
        //     $partner_filter->industry_id = $data['filter']['industry'];
        // }
        if(isset($data['filter']['vendor'])){
            $partner_filter->vendor_id = $data['filter']['vendor'];
        }
        if(isset($data['filter']['type_of_incentive'])){
            $partner_filter->type_of_incentive_id = $data['filter']['type_of_incentive'];
        }
        if(isset($data['filter']['startdt'])){
            $partner_filter->to_month = $data['filter']['startdt'];
        }
        if(isset($data['filter']['enddt'])){
            $partner_filter->from_month = $data['filter']['enddt'];
        }
        
        /* print_r($partner_filter);
        exit(); */

        $events =Helper::get_filtered_events($partner_filter,'reward_incentive');
        $view = view('partner.partial_filter', compact('events'));
        /* echo $view;
        exit(); */

        $search_parameter = [];
        if(isset($partner_filter->city_id) && $partner_filter->city_id != 0){
            $search_parameter['city'] = City::find($partner_filter->city_id)->name;
        }
        if(isset($partner_filter->state_id) && $partner_filter->state_id != 0){
            $search_parameter['state'] = State::find($partner_filter->state_id)->name;
        }
        if(isset($partner_filter->to_month) && $partner_filter->to_month != 0){
            $search_parameter['month'] = \Carbon\Carbon::parse($partner_filter->to_month)->format('d/M/Y').' - '.\Carbon\Carbon::parse($partner_filter->from_month)->format('d/M/Y'); 
        }
        if(isset($partner_filter->solution_id) && $partner_filter->solution_id != 0){
            $search_parameter['solution'] = Solution::find($partner_filter->solution_id)->name;
        }
        // if(isset($partner_filter->industry_id)){
        //     $search_parameter['industry'] = Industry::find($partner_filter->industry_id)->name;
        // }
        if(isset($partner_filter->vendor_id) && $partner_filter->vendor_id != 0){
            $search_parameter['vendor'] = Vendor::find($partner_filter->vendor_id)->name;
        }
        if(isset($partner_filter->type_of_incentive_id) && $partner_filter->type_of_incentive_id != 0){
            $search_parameter['type_of_incentive'] = Type_of_incentive::find($partner_filter->type_of_incentive_id)->name;
        }

        echo json_encode(['display'=> "'".$view."'", 'filter'=> implode(' | ', $search_parameter)]);
        exit();
    }

    public function admin_rewards_incentives_edit($id){
        $id = Crypt::decrypt($id);
        $event = Event::find($id);
        $cities = City::get();
        $states = State::get();
        $solutions = Solution::get();
        //$industries = Industry::get();
        $vendors = Vendor::get();
        $type_of_events = Type_of_incentive::get();

        return view('reward_incentive.edit', compact('event', 'cities', 'states', 'solutions', 'vendors','type_of_events'));
    }

    public function admin_rewards_incentives(){
        $events = Event::where('is_deleted',0)->where('category','reward_incentive')->get();
        return view('admin.rewards_incentives', compact('events'));
    }

    public function partner_rewards_incentives_calender(){
        //$events = Auth::user()->getUserEventShortlist;
        $events = Helper::get_shortlisted_events('reward_incentive');
        return view('reward_incentive.partner_calender', compact('events'));
    }

}
