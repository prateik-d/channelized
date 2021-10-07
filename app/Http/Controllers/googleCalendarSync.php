<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use DateTimeZone;
use App\Event;
use App\Syncevents;
use Auth, Crypt, Session;

class googleCalendarSync extends Controller
{
    //
    protected $client;
    
    public function __construct()
    {
        $client = new Google_Client();
        $client->setAuthConfig(env('GOOGLE_APPLICATION_CREDENTIALS'));
        $client->addScope(Google_Service_Calendar::CALENDAR);

        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
        $client->setHttpClient($guzzleClient);
        
        $this->client = $client;
    }
    public function index()
    {
        session_start();
//        $_SESSION['access_token'] = null;
//        die();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);

            $calendarId = 'primary';

            $results = $service->events->listEvents($calendarId);
            return $results->getItems();

        } else {
            return redirect()->route('oauthCallback');
        }

    }

    public function oauth()
    {
        session_start();

        //$rurl = 'https://siyahrms-channelised.azurewebsites.net/oauth';
        $rurl = action('googleCalendarSync@oauth');
        $this->client->setRedirectUri($rurl);
        if (!isset($_GET['code'])) {
            $auth_url = $this->client->createAuthUrl();
            $filtered_url = filter_var($auth_url, FILTER_SANITIZE_URL);
            return redirect($filtered_url);
        } else {
            $this->client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $this->client->getAccessToken();
            
            if(session()->has('google_calendar_event_id')){
                return redirect()->route('gcalendar_sync',Session::get('google_calendar_event_id'));
            }
            return redirect()->route(Auth::user()->roles[0]->name.'.events.calender');
             //return redirect()->route('gcalendar.index');
        }
    }
    public function syncadd($id){

        //dd($this->client->getAccessToken());
        $id = Crypt::decrypt($id);
    	$events = Event::find($id);
        $userId =  Auth::user()->id; 

        $is_sync = Syncevents::where('event_id',$id)->where('user_id',$userId)->where('gsync','1')->exists();
        if($is_sync){
            return redirect()->back()->with('info', 'This event is already sync with google');
        }
    	$st = $events->start_date."T".$events->start_duration;
    	$et = $events->end_date."T".$events->end_duration;
    	
    	$name = $events->name;
    	$description = $events->summary;
        
        $tz = new DateTimeZone($events->timezone);
        $st = Carbon::parse($st, $tz);
        $et = Carbon::parse($et, $tz);

        $googleStartTime = new Google_Service_Calendar_EventDateTime();
        $googleStartTime->setTimeZone($tz);
        $googleStartTime->setDateTime($st->format('c'));
        
        $googleEndTime = new Google_Service_Calendar_EventDateTime();
        $googleEndTime->setTimeZone($tz);
        $googleEndTime->setDateTime($et->format('c'));
        
        ////////////////
        session_start();
        $startDateTime = $googleStartTime->dateTime; 
        $endDateTime = $googleEndTime->dateTime;
        
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
        /* if (!empty($this->client->getAccessToken())) { */
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);

            $calendarId = 'primary';
            $event = new Google_Service_Calendar_Event([
                'summary' => $name,
                'description' => $description,
                'start' => ['dateTime' => $startDateTime],
                'end' => ['dateTime' => $endDateTime],
                'reminders' => ['useDefault' => true],
            ]);
            /* print_r($event);
            die(); */
            $results = $service->events->insert($calendarId, $event);
            if (!$results) {
                return redirect()->route(Auth::user()->roles[0]->name.'.events.calender')
                    ->with('info', 'Something went wrong');
            }
            if(session()->has('google_calendar_event_id')){
                session()->forget('google_calendar_event_id');
            }
            Syncevents::updateOrCreate(
                ['user_id'=>$userId,'event_id'=>$id],
                ['gsync'=>1]
            );

            return redirect()->route(Auth::user()->roles[0]->name.'.events.calender')
                ->with('msg', 'Event successfully sync with google calendar.');
        } else {
            $id = Crypt::encrypt($id);
            session(['google_calendar_event_id' => $id]);
            return redirect()->route('oauthCallback');
        }
    }
}
