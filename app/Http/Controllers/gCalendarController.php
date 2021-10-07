<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use DateTimeZone;

class gCalendarController extends Controller
{
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            return redirect()->route('demooauthCallback');
        }

    }

    public function oauth()
    {
        session_start();
        
        $rurl = action('gCalendarController@oauth');
        $this->client->setRedirectUri($rurl);
        if (!isset($_GET['code'])) {
            /* dd(12); */
            $auth_url = $this->client->createAuthUrl();
            $filtered_url = filter_var($auth_url, FILTER_SANITIZE_URL);
            return redirect($filtered_url);
        } else {
            /* dd(34); */
            $this->client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $this->client->getAccessToken();
            
            return redirect()->route('gcalendar.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        /* $timestamp = '2020-04-23 13:43:00';
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'Asia/Calcutta');
        $date->setTimezone('America/Los_Angeles');

        print_r($timestamp);
        echo '<br />';
        print_r($date->format('c'));
        exit(); */

        //$timezone =  $this->getTimezone('America/Montreal');
        //dd($timezone);
        // Set the start time and date for pushing to Google.
        /* $etz = new DateTimeZone('Asia/Calcutta');
        $tz = new DateTimeZone('America/Los_Angeles');
        
        $startTime = Carbon::create(
            2020,
            05,
            20,
            10,
            0,
            0,
            $etz
        );

        print_r($startTime->format('c'));
        die(); */


        //dd($startTime);
//        // Use the Google date handling provided by the Google Client
        /* $googleStartTime = new Google_Service_Calendar_EventDateTime();
        $googleStartTime->setTimeZone($tz);
        $googleStartTime->setDateTime($startTime->format('c')); */
        /* echo '<pre>';
        print_r($startTime);
        print_r($date); */
        /* print_r($googleStartTime); */
       /*  exit; */
        return view('calendar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /* print_r($request->all()); */
        /* exit(); */
        /* $tz = new DateTimeZone($request->tz); */
        $tz = new DateTimeZone('America/Los_Angeles');
        $st = Carbon::parse($request->start_date, 'Asia/Calcutta')->setTimezone($tz);
        $et = Carbon::parse($request->end_date, 'Asia/Calcutta')->setTimezone($tz);
        
        /* print_r($st);
        print_r($et);
        exit(); */
        // Use the Google date handling provided by the Google Client
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
        
        /* print_r($startDateTime);
        dd($endDateTime); */

        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);

            $calendarId = 'primary';
            $event = new Google_Service_Calendar_Event([
                'summary' => $request->title,
                'description' => $request->description,
                'start' => ['dateTime' => $startDateTime],
                'end' => ['dateTime' => $endDateTime],
                'reminders' => ['useDefault' => true],
            ]);
            $results = $service->events->insert($calendarId, $event);
            if (!$results) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return response()->json(['status' => 'success', 'message' => 'Event Created']);
        } else {
            return redirect()->route('demooauthCallback');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $eventId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show($eventId)
    {
        session_start();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);

            $service = new Google_Service_Calendar($this->client);
            $event = $service->events->get('primary', $eventId);

            if (!$event) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return response()->json(['status' => 'success', 'data' => $event]);

        } else {
            return redirect()->route('demooauthCallback');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $eventId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, $eventId)
    {
        session_start();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);

            $startDateTime = Carbon::parse($request->start_date)->toRfc3339String();

            $eventDuration = 30; //minutes

            if ($request->has('end_date')) {
                $endDateTime = Carbon::parse($request->end_date)->toRfc3339String();

            } else {
                $endDateTime = Carbon::parse($request->start_date)->addMinutes($eventDuration)->toRfc3339String();
            }

            // retrieve the event from the API.
            $event = $service->events->get('primary', $eventId);

            $event->setSummary($request->title);

            $event->setDescription($request->description);

            //start time
            $start = new Google_Service_Calendar_EventDateTime();
            $start->setDateTime($startDateTime);
            $event->setStart($start);

            //end time
            $end = new Google_Service_Calendar_EventDateTime();
            $end->setDateTime($endDateTime);
            $event->setEnd($end);

            $updatedEvent = $service->events->update('primary', $event->getId(), $event);


            if (!$updatedEvent) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return response()->json(['status' => 'success', 'data' => $updatedEvent]);

        } else {
            return redirect()->route('demooauthCallback');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $eventId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy($eventId)
    {
        session_start();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);

            $service->events->delete('primary', $eventId);

        } else {
            return redirect()->route('demooauthCallback');
        }
    }
    
    protected function getClientIp()
    {
        $ip = \request()->ip();
        return $ip == '127.0.0.1' ? '43.242.116.170' : $ip;
    }

    protected function getTimezone($tmz)
    {
        if ($timezone = $tmz) {
            return $timezone;
        }

        // fetch it from FreeGeoIp
        $ip = $this->getClientIp();
        
        try {
            $response = json_decode(file_get_contents('http://freegeoip.net/json/' . $ip), true);
            return array_get($response, 'time_zone');
        } catch (\Exception $e) {}
    }
}
