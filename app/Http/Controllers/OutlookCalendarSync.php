<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use App\TokenStore\TokenCache;
use Auth, Session, Crypt;
use App\Event;
use App\Syncevents;

class OutlookCalendarSync extends Controller
{
    public function signin(){

        // Initialize the OAuth client
        $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
        'clientId'                => env('OAUTH_APP_ID'),
        'clientSecret'            => env('OAUTH_APP_PASSWORD'),
        'redirectUri'             => env('OAUTH_REDIRECT_URI'),
        'urlAuthorize'            => env('OAUTH_AUTHORITY').env('OAUTH_AUTHORIZE_ENDPOINT'),
        'urlAccessToken'          => env('OAUTH_AUTHORITY').env('OAUTH_TOKEN_ENDPOINT'),
        'urlResourceOwnerDetails' => '',
        'scopes'                  => env('OAUTH_SCOPES')
        ]);

        $authUrl = $oauthClient->getAuthorizationUrl();

        // Save client state so we can validate in callback
        session(['oauthState' => $oauthClient->getState()]);

        // Redirect to AAD signin page
        return redirect()->away($authUrl);
    }

    public function callback(Request $request){
        // Validate state
        $expectedState = session('oauthState');
        $request->session()->forget('oauthState');
        $providedState = $request->query('state');

        if (!isset($expectedState) || !isset($providedState) || $expectedState != $providedState) {
            return redirect()->route(Auth::user()->roles[0]->name.'.events.calender')
                ->with('error', 'Invalid auth state')
                ->with('errorDetail', 'The provided auth state did not match the expected value');
        }
    
        // Authorization code should be in the "code" query param
        $authCode = $request->query('code');
        if (isset($authCode)) {
            // Initialize the OAuth client
            $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
                'clientId'                => env('OAUTH_APP_ID'),
                'clientSecret'            => env('OAUTH_APP_PASSWORD'),
                'redirectUri'             => env('OAUTH_REDIRECT_URI'),
                'urlAuthorize'            => env('OAUTH_AUTHORITY').env('OAUTH_AUTHORIZE_ENDPOINT'),
                'urlAccessToken'          => env('OAUTH_AUTHORITY').env('OAUTH_TOKEN_ENDPOINT'),
                'urlResourceOwnerDetails' => '',
                'scopes'                  => env('OAUTH_SCOPES')
            ]);
        
            try {
                // Make the token request
                $accessToken = $oauthClient->getAccessToken('authorization_code', [
                    'code' => $authCode
                ]);

                $graph = new Graph();
                $graph->setAccessToken($accessToken->getToken());

                $user = $graph->createRequest('GET', '/me')
                    ->setReturnType(Model\User::class)
                    ->execute();

                $tokenCache = new TokenCache();
                $tokenCache->storeTokens($accessToken, $user);
                return redirect('/outlook_calendar_sync/'.Session::get('outlook_calendar_event_id'));
            }catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
                return redirect()->route(Auth::user()->roles[0]->name.'.events.calender')
                    ->with('error', 'Error requesting access token')
                    ->with('errorDetail', $e->getMessage());
            }
        }

        return redirect()->route(Auth::user()->roles[0]->name.'.events.calender')
            ->with('error', $request->query('error'))
            ->with('errorDetail', $request->query('error_description'));
    }

    public function calendar_sync($id){
        // Get the access token from the cache
        $tokenCache = new TokenCache();
        $accessToken = $tokenCache->getAccessToken();
        
        $id = Crypt::decrypt($id);
        $userId = Auth::user()->id;

        $is_sync = Syncevents::where('event_id',$id)->where('user_id',$userId)->where('osync','1')->exists();
        if($is_sync){
            return redirect()->back()->with('info', 'This event is already sync with outlook');
        }

        if(empty($accessToken)){
            // store event value in session
            $id = Crypt::encrypt($id);
            session(['outlook_calendar_event_id' => $id]);
            return redirect('outlook_signin');
        }

        /* print_r($id);
        dd(Event::find($id)); */

        $event = Event::find($id);
        /* print_r($event);
        die(); */
        $start = array(
          'dateTime' => $event->start_date."T".$event->start_duration,
          'timeZone' => $event->timezone
        );
        
        $end = array(
          'dateTime' => $event->end_date."T".$event->end_duration,
          'timeZone' => $event->timezone
        );
    
        $dataArr = [
          "subject" => $event->name,
          "body"=> array(
            "contentType" => "TEXT",
            "content" => $event->summary
          ),
          "start" => $start,
          "end" => $end
        ];
    
        /* print_r($dataArr);
        exit(); */
        
        // Create a Graph client
        $graph = new Graph();
        $graph->setAccessToken($accessToken);
        
        // Append query parameters to the '/me/events' url
        $getDrivesUrl = '/me/events';
        
        $event = $graph->createRequest('POST', $getDrivesUrl)
            ->attachBody($dataArr)
            ->setReturnType(Model\Event::class)
            ->execute();
        
        
        if(strlen($event->getId()) > 0){
            if(session()->has('outlook_calendar_event_id')){
                session()->forget('outlook_calendar_event_id');
            }
            Syncevents::updateOrCreate(
                ['user_id'=>$userId,'event_id'=>$id],
                ['osync'=>1]
            );

            return redirect()->route(Auth::user()->roles[0]->name.'.events.calender')
                ->with('msg', 'Event successfully sync with outlook calendar.');
        }else{
            return redirect()->route(Auth::user()->roles[0]->name.'.events.calender')
                ->with('info', 'Error while adding event in outlook calendar');
        }
    }
}
