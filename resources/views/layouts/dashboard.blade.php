<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Channelised') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet"/>
    <!-- Styles -->
    <link href="{{ asset('public/assets/sass/app.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/assets/sass/style.css') }}" />
    <!-- fullcalendar style -->
    <link href="{{ asset('public/assets/js/fullcalendar-4.4.0/packages/core/main.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/js/fullcalendar-4.4.0/packages/daygrid/main.css') }}" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="{{ asset('public/assets/css/custome_table.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('public/assets/css/data_Tables.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/home-style.css')}}" />
    @stack('css')
</head>
<body>
    @if(Auth::user()->roles[0]->name=="partner")
        <div class="partner-dashboard admin-main-outer partner-color">
    @elseif(Auth::user()->roles[0]->name=="vendor")
        <div class="partner-dashboard admin-main-outer vendor-color">
    @else
        <div class="partner-dashboard admin-main-outer vendor-color">
    @endif
    <aside>
    <div class="menu-icon menu-highlight" style="background:url('{{ asset('public/assets/images/menu-option-icon-selected.png') }}')">
        
                </div>
        <div class="admin-logo">
            <a class="logo" href="{{ url('/') }}">
                <!-- <img src="{{ asset('public/assets/images/admin-logo.svg') }}" alt="{{ config('app.name', 'Channelised') }}" /> -->
                <svg xmlns="http://www.w3.org/2000/svg" width="168.129" height="26.062" viewBox="0 0 168.129 26.062">
    <defs>
        <style>
            .a {
                fill: #fff;
            }
        </style>
    </defs>
    <g transform="translate(-46.08 -15.08)">
        <path class="a chr"
            d="M176.133,61.708a5.986,5.986,0,0,1-3.06-.777,5.675,5.675,0,0,1-2.1-2.115,5.988,5.988,0,0,1-.761-3.022,6.206,6.206,0,0,1,.75-3.074,5.464,5.464,0,0,1,2.063-2.1,5.893,5.893,0,0,1,3.005-.758,5.349,5.349,0,0,1,4.211,1.923.761.761,0,0,1,.214.7,1.1,1.1,0,0,1-.472.64.824.824,0,0,1-.665.14,1.3,1.3,0,0,1-.668-.374,3.453,3.453,0,0,0-2.621-1.1,3.7,3.7,0,0,0-1.923.5,3.467,3.467,0,0,0-1.31,1.4,4.456,4.456,0,0,0-.473,2.112,4.241,4.241,0,0,0,.483,2.052,3.664,3.664,0,0,0,1.341,1.42,3.769,3.769,0,0,0,1.989.508,4.352,4.352,0,0,0,1.321-.181,3.113,3.113,0,0,0,1.041-.569,1.3,1.3,0,0,1,.72-.308.849.849,0,0,1,.646.2,1.019,1.019,0,0,1,.409.673.788.788,0,0,1-.258.67,5.472,5.472,0,0,1-3.879,1.434Z"
            transform="translate(-90.028 -25.223)" />
        <path class="a chr"
            d="M230.4,42.215V47.47a1.069,1.069,0,0,1-.31.78,1.1,1.1,0,0,1-.786.308,1.074,1.074,0,0,1-.783-.308,1.058,1.058,0,0,1-.31-.78V42.215a3.939,3.939,0,0,0-.451-1.989,2.838,2.838,0,0,0-1.214-1.14,3.92,3.92,0,0,0-1.75-.374,3.643,3.643,0,0,0-1.632.36,3.057,3.057,0,0,0-1.162.975,2.359,2.359,0,0,0-.429,1.4V47.47a1.095,1.095,0,1,1-2.189,0V32.944a1.041,1.041,0,0,1,.31-.8,1.1,1.1,0,0,1,1.879.791v5.252a4.761,4.761,0,0,1,1.1-.808,5.274,5.274,0,0,1,2.557-.621,5.472,5.472,0,0,1,2.651.635,4.511,4.511,0,0,1,1.835,1.832A6.082,6.082,0,0,1,230.4,42.215Z"
            transform="translate(-125.697 -12.139)" />
        <path class="a chr"
            d="M281.632,52.741a5.769,5.769,0,0,0-5.123-2.9,5.906,5.906,0,0,0-3.022.777,5.8,5.8,0,0,0-2.126,2.126,5.925,5.925,0,0,0-.783,3.022,6.285,6.285,0,0,0,.72,3.022,5.541,5.541,0,0,0,1.964,2.115,5.34,5.34,0,0,0,6.958-1.17v.8a1.06,1.06,0,0,0,.313.78,1.151,1.151,0,0,0,1.566,0,1.06,1.06,0,0,0,.313-.78V55.773a5.926,5.926,0,0,0-.78-3.033Zm-1.819,5.074a3.771,3.771,0,0,1-6.623,0,4.1,4.1,0,0,1-.505-2.041,4.156,4.156,0,0,1,.505-2.06,3.78,3.78,0,0,1,1.373-1.431,3.739,3.739,0,0,1,5.25,1.445,4.211,4.211,0,0,1,.5,2.06A4.158,4.158,0,0,1,279.814,57.814Z"
            transform="translate(-162.827 -25.208)" />
        <path class="a chr"
            d="M336.537,55.256v5.255a1.06,1.06,0,0,1-1.1,1.1,1.074,1.074,0,0,1-.783-.308,1.06,1.06,0,0,1-.313-.78V55.256a3.884,3.884,0,0,0-.459-1.989,2.808,2.808,0,0,0-1.214-1.14,3.9,3.9,0,0,0-1.75-.374,3.659,3.659,0,0,0-1.632.36,3.068,3.068,0,0,0-1.159.975,2.343,2.343,0,0,0-.431,1.4v6.027a1.095,1.095,0,1,1-2.189,0V50.985a1.06,1.06,0,0,1,.31-.794,1.2,1.2,0,0,1,1.582,0,1.1,1.1,0,0,1,.3.794v.242a4.9,4.9,0,0,1,1.1-.808,5.261,5.261,0,0,1,2.552-.621,5.494,5.494,0,0,1,2.656.635,4.541,4.541,0,0,1,1.846,1.846A6.082,6.082,0,0,1,336.537,55.256Z"
            transform="translate(-202.667 -25.18)" />
        <path class="a chr"
            d="M389.926,55.256v5.255a1.068,1.068,0,0,1-.31.78,1.1,1.1,0,0,1-.788.308,1.074,1.074,0,0,1-.783-.308,1.058,1.058,0,0,1-.316-.78V55.256a3.912,3.912,0,0,0-.453-1.989,2.816,2.816,0,0,0-1.195-1.14,3.937,3.937,0,0,0-1.75-.374,3.643,3.643,0,0,0-1.632.36,3.057,3.057,0,0,0-1.162.975,2.36,2.36,0,0,0-.429,1.4v6.027a1.1,1.1,0,1,1-2.192,0V50.985a1.052,1.052,0,0,1,.3-.794,1.1,1.1,0,0,1,1.879.794v.242a4.623,4.623,0,0,1,1.1-.808,5.274,5.274,0,0,1,2.558-.621,5.472,5.472,0,0,1,2.651.635,4.524,4.524,0,0,1,1.846,1.846A6.082,6.082,0,0,1,389.926,55.256Z"
            transform="translate(-241.403 -25.18)" />
        <path class="a chr"
            d="M440.863,56.251a.89.89,0,0,0,.275-.673,6.705,6.705,0,0,0-.632-2.978,4.835,4.835,0,0,0-1.838-2.03,5.4,5.4,0,0,0-2.879-.736,5.9,5.9,0,0,0-3.008.758,5.4,5.4,0,0,0-2.049,2.093A6.252,6.252,0,0,0,430,55.771a5.942,5.942,0,0,0,.786,3.066,5.494,5.494,0,0,0,2.167,2.093,6.593,6.593,0,0,0,5.241.4A5.871,5.871,0,0,0,440,60.386a.753.753,0,0,0,.343-.662,1,1,0,0,0-.385-.7.953.953,0,0,0-.657-.225,1.209,1.209,0,0,0-.7.244,4.233,4.233,0,0,1-1.129.569,4.12,4.12,0,0,1-1.373.242,4.349,4.349,0,0,1-2.167-.533,3.939,3.939,0,0,1-1.483-1.45,3.873,3.873,0,0,1-.478-1.349h8.183A.978.978,0,0,0,440.863,56.251Zm-8.851-1.428a4.433,4.433,0,0,1,.368-1.14,3.442,3.442,0,0,1,1.321-1.464,3.906,3.906,0,0,1,2.093-.533,3.132,3.132,0,0,1,2.991,1.81,4.279,4.279,0,0,1,.376,1.327Z"
            transform="translate(-278.451 -25.206)" />
        <path class="a chr"
            d="M482.4,48.633a2.857,2.857,0,0,1-1.676-.511,3.409,3.409,0,0,1-1.137-1.4,4.819,4.819,0,0,1-.407-2.038V33.019a1.038,1.038,0,0,1,.3-.769,1.148,1.148,0,0,1,1.547,0,1.038,1.038,0,0,1,.3.769V44.683a2.539,2.539,0,0,0,.3,1.3.89.89,0,0,0,.772.514h.549a.89.89,0,0,1,.687.3,1.1,1.1,0,0,1,.275.769.909.909,0,0,1-.409.766,1.73,1.73,0,0,1-1.052.3Z"
            transform="translate(-314.123 -12.236)" />
        <path class="a chr"
            d="M505.246,35.788a1.4,1.4,0,0,1-1-2.4,1.409,1.409,0,1,1,1,2.4Zm0,13.584a1.058,1.058,0,0,1-1.1-1.1v-9.5a1.035,1.035,0,0,1,.31-.788,1.192,1.192,0,0,1,1.579,0,1.058,1.058,0,0,1,.308.788v9.508a1.077,1.077,0,0,1-.3.78A1.06,1.06,0,0,1,505.246,49.373Z"
            transform="translate(-332 -12.976)" />
        <path class="a chr"
            d="M530.024,61.686a8.121,8.121,0,0,1-2.78-.459,5.318,5.318,0,0,1-1.989-1.165.923.923,0,0,1-.275-.78,1.033,1.033,0,0,1,.418-.717,1.124,1.124,0,0,1,.849-.275,1.159,1.159,0,0,1,.728.374,3.387,3.387,0,0,0,1.17.758,4.412,4.412,0,0,0,1.794.341,3.656,3.656,0,0,0,1.909-.407,1.258,1.258,0,0,0,.676-1.047,1.308,1.308,0,0,0-.613-1.1,5.859,5.859,0,0,0-2.307-.766,6.72,6.72,0,0,1-3.148-1.283,2.673,2.673,0,0,1-.975-2.093,2.6,2.6,0,0,1,.635-1.821,3.926,3.926,0,0,1,1.648-1.069,6.318,6.318,0,0,1,2.1-.352,6.593,6.593,0,0,1,2.53.451,4.269,4.269,0,0,1,1.728,1.244.989.989,0,0,1,.275.717.825.825,0,0,1-.354.624,1.052,1.052,0,0,1-.824.148,1.511,1.511,0,0,1-.794-.385,2.931,2.931,0,0,0-1.159-.7,4.871,4.871,0,0,0-1.439-.192,3.648,3.648,0,0,0-1.6.319,1.014,1.014,0,0,0-.654.942,1.239,1.239,0,0,0,.2.692,1.714,1.714,0,0,0,.8.549,10.619,10.619,0,0,0,1.761.478,9.675,9.675,0,0,1,2.547.824,3.4,3.4,0,0,1,1.343,1.143,2.8,2.8,0,0,1,.407,1.505,3.146,3.146,0,0,1-.525,1.775,3.639,3.639,0,0,1-1.547,1.258,6.093,6.093,0,0,1-2.544.47Z"
            transform="translate(-347.339 -25.201)" />
        <path class="a chr"
            d="M578.917,56.251a.879.879,0,0,0,.275-.673,6.67,6.67,0,0,0-.635-2.978,4.791,4.791,0,0,0-1.835-2.03,5.4,5.4,0,0,0-2.876-.736,5.9,5.9,0,0,0-3.008.758,5.407,5.407,0,0,0-2.052,2.093,6.281,6.281,0,0,0-.739,3.085,5.94,5.94,0,0,0,.783,3.066A5.5,5.5,0,0,0,571,60.93a6.593,6.593,0,0,0,5.239.4,5.887,5.887,0,0,0,1.816-.939.752.752,0,0,0,.343-.662,1.016,1.016,0,0,0-.387-.7.95.95,0,0,0-.654-.225,1.217,1.217,0,0,0-.7.244,4.254,4.254,0,0,1-1.126.569,4.12,4.12,0,0,1-1.374.242,4.351,4.351,0,0,1-2.17-.533,3.932,3.932,0,0,1-1.481-1.45,3.821,3.821,0,0,1-.478-1.349h8.167A.972.972,0,0,0,578.917,56.251Zm-8.848-1.428a4.227,4.227,0,0,1,.365-1.14,3.478,3.478,0,0,1,1.321-1.464,3.918,3.918,0,0,1,2.1-.533,3.123,3.123,0,0,1,2.972,1.81,4.124,4.124,0,0,1,.393,1.327Z"
            transform="translate(-378.579 -25.206)" />
        <path class="a chr"
            d="M626.543,32.217a1.2,1.2,0,0,0-1.58,0,1.052,1.052,0,0,0-.31.791v5.769a5.283,5.283,0,0,0-4.148-1.945,5.194,5.194,0,0,0-2.813.777,5.6,5.6,0,0,0-1.964,2.115,6.291,6.291,0,0,0-.72,3.022,5.909,5.909,0,0,0,.786,3.022A5.748,5.748,0,0,0,617.92,47.9a5.9,5.9,0,0,0,3.022.78,5.788,5.788,0,0,0,5.123-2.909,5.909,5.909,0,0,0,.783-3.022V33.02A1.066,1.066,0,0,0,626.543,32.217Zm-2.3,12.581a3.794,3.794,0,0,1-5.25,1.442A3.739,3.739,0,0,1,617.62,44.8a4.2,4.2,0,0,1-.5-2.049,4.122,4.122,0,0,1,.5-2.052,3.8,3.8,0,0,1,1.374-1.42,3.9,3.9,0,0,1,3.9,0,3.733,3.733,0,0,1,1.352,1.42,4.177,4.177,0,0,1,.494,2.052,4.258,4.258,0,0,1-.483,2.06Z"
            transform="translate(-412.64 -12.215)" />
        <path class="a"
            d="M97.752,15.08a8.92,8.92,0,0,0-8.626,6.593h0a8.964,8.964,0,0,0-.3,2.288v2.247a8.815,8.815,0,0,0,2.519,6.181l.1.1a8.543,8.543,0,0,0,.7.632,8.81,8.81,0,0,0,2.5,1.412h0a8.939,8.939,0,0,0,12.04-8.326V23.958A8.9,8.9,0,0,0,97.752,15.08ZM104,25.87a6.25,6.25,0,0,1-12.5,0v-.5c0-2.308-2.25-3.623-2.373-3.7h2.961A6.255,6.255,0,0,1,104,24.3Z"
            transform="translate(-31.006 0)" />
        <path class="a"
            d="M63.639,50.44H60.672a6.255,6.255,0,0,1-11.911-2.626V46.239a6.255,6.255,0,0,1,9.065-5.549v-.824a8.966,8.966,0,0,1,.3-2.289A8.931,8.931,0,0,0,46.08,45.9v2.247a8.933,8.933,0,0,0,17.559,2.294h0Z"
            transform="translate(0 -15.911)" />
    </g>
</svg>
            
            </a>
        </div>
        <div class="side-menu scrollbar" id="scrollbar-custom">
            <ul id="side-menu">
                @guest
                    <li>
                        <a class="" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register_plan'))
                        <li>
                            <a class="" href="{{ route('register_plan') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    @hasanyroles(['vendor','partner'])
                        <li>
                            <a href="{{ route(Auth::user()->roles[0]->name.'.home') }}" class="{{ (request()->routeIs('*home') ? 'active' : '') }}">
                                <i class="side-menu-icon dashboard-icon"></i>
                                <div class="side-menu-name">
                                    Dashboard
                                </div>
                            </a>
                        </li>
                    @endhasanyroles
                    @hasrole('vendor')


                        <li>
                            <a href="{{ route(Auth::user()->roles[0]->name.'.vtemplatePage') }}" class="{{ (request()->routeIs('vendor.vtemplatePage*') ? 'active' : '') }}">
                                <i class="side-menu-icon event-icon"> </i>
                               
                                <div class="side-menu-name">Landing Page</div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route(Auth::user()->roles[0]->name.'.events.index') }}" class="{{ (request()->routeIs('vendor.events*') ? 'active' : '') }}">
                                <i class="side-menu-icon event-icon"> </i>
                                @php
                                    $sevents = Helper::get_active_events()->where('added_by',Auth::user()->id);
                                @endphp
                                <div class="side-menu-name">Events {!! ($sevents->count() > 0 ? '<span>'.$sevents->count().'</span>' : null) !!}</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route(Auth::user()->roles[0]->name.'.rewards-incentives.index') }}" class="{{ (request()->routeIs('vendor.rewards-incentives*') ? 'active' : '') }}">
                                <i class="side-menu-icon incentives-icon"> </i>
                                @php
                                    $vrewards = Helper::get_active_rewards_incentives()->where('added_by',Auth::user()->id);
                                @endphp
                                <div class="side-menu-name">Rewards & Incentives {!! ($vrewards->count() > 0 ? '<span>'.$vrewards->count().'</span>' : null) !!}</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route(Auth::user()->roles[0]->name.'.offers.index') }}" class="{{ (request()->routeIs('vendor.offers*') ? 'active' : '') }}" >
                                <i class="side-menu-icon learnAndGrow-icon"> </i>
                                @php
                                    $voffers = Helper::get_active_product_promotion_offer()->where('added_by',Auth::user()->id);
                                @endphp
                                <div class="side-menu-name">Product Promotions & Offers {!! ($voffers->count() > 0 ? '<span>'.$voffers->count().'</span>' : null) !!}</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route(Auth::user()->roles[0]->name.'.technical-education.index') }}" class="{{ (request()->routeIs('vendor.technical-education*') ? 'active' : '') }}">
                                <i class="side-menu-icon learnAndGrow-icon"> </i>
                                @php
                                    $vTechnical = Helper::get_active_technical_education()->where('added_by',Auth::user()->id);
                                @endphp
                                <div class="side-menu-name">Technical Education {!! ($vTechnical->count() > 0 ? '<span>'.$vTechnical->count().'</span>' : null) !!}</div>
                            </a>
                        </li>
                       <!--  <li>
                            <a href="">
                                <i class="side-menu-icon announcements-icon"> </i>
                                <div class="side-menu-name">Announcements</div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="side-menu-icon collaborate-icon"> </i>
                                <div class="side-menu-name">Collaborate</div>
                            </a>
                        </li> -->
                    @endhasrole
                    @hasrole('partner')

                        <li>
                            <a href="{{ route(Auth::user()->roles[0]->name.'.ptemplatePage') }}" class="{{ (request()->routeIs('partner.ptemplatePage*') ? 'active' : '') }}">
                                <i class="side-menu-icon event-icon"> </i>
                               
                                <div class="side-menu-name">Landing Page</div>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route(Auth::user()->roles[0]->name.'.events') }}" class="{{ (request()->routeIs('partner.events*') ? 'active' : '') }}">
                                <i class="side-menu-icon event-icon"> </i>
                                @php
                                    $sfilter_events_count = 0;
                                    $partner_filter = Auth::user()->getPartnerFilter()->where('category','event')->first();
                                    if($partner_filter){
                                        $sfilter_events = Helper::get_filtered_events($partner_filter,'event');
                                        $sfilter_events_count = $sfilter_events->count();
                                    }else{
                                        $sfilter_events_count = Helper::get_active_events()->count();
                                    }
                                @endphp
                                <div class="side-menu-name">Client Events{!! ($sfilter_events_count > 0 ? '<span>'.$sfilter_events_count.'</span>' : null) !!}</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route(Auth::user()->roles[0]->name.'.rewards-incentives') }}" class="{{ (request()->routeIs('partner.rewards-incentives*') ? 'active' : '') }}">
                                <i class="side-menu-icon incentives-icon"> </i>
                          @php
                                $sfilter_rewards_incentives_count = 0;
                                $rewards_partner_filter = Auth::user()->getPartnerFilter()->where('category','reward_incentive')->first();
                            if($rewards_partner_filter){
                                $sfilter_rewards_incentives = Helper::get_filtered_events($rewards_partner_filter,'reward_incentive');
                                $sfilter_rewards_incentives_count = $sfilter_rewards_incentives->count();
                             }else{
                                $sfilter_rewards_incentives_count = Helper::get_active_rewards_incentives()->count();
                            }
                        @endphp
                                <div class="side-menu-name">
                                Rewards & Incentives{!! ($sfilter_rewards_incentives_count > 0 ? '<span>'.$sfilter_rewards_incentives_count.'</span>' : null) !!}
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route(Auth::user()->roles[0]->name.'.product-promotions-offers') }}" class="{{ (request()->routeIs('partner.product-promotions-offers*') ? 'active' : '') }}">
                                <i class="side-menu-icon pomotions-icon"> </i>
                                @php
                                    $sfilter_offers_count = 0;
                                    $partner_filter = Auth::user()->getPartnerFilter()->where('category','product_promotion_offer')->first();
                                    if($partner_filter){
                                        $sfilter_offers = Helper::get_filtered_events($partner_filter,'product_promotion_offer');
                                        $sfilter_offers_count = $sfilter_offers->count();
                                    }else{
                                        $sfilter_offers_count = Helper::get_active_product_promotion_offer()->count();
                                    }
                                @endphp
                                <div class="side-menu-name">Product Promotions & Offers{!! ($sfilter_offers_count > 0 ? '<span>'.$sfilter_offers_count.'</span>' : null) !!}</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route(Auth::user()->roles[0]->name.'.technical-education') }}" class="{{ (request()->routeIs('partner.technical-education*') ? 'active' : '') }}">
                                <i class="side-menu-icon learnAndGrow-icon"> </i>
                                @php
                                    $sfilter_technical_education_count = 0;
                                    $partner_filter = Auth::user()->getPartnerFilter()->where('category','technical_education')->first();
                                    if($partner_filter){
                                        $sfilter_technical_education = Helper::get_filtered_events($partner_filter,'technical_education');
                                        $sfilter_technical_education_count = $sfilter_technical_education->count();
                                    }else{
                                        $sfilter_technical_education_count = Helper::get_active_technical_education()->count();
                                    }
                                @endphp
                                <div class="side-menu-name">
                                Technical Education{!! ($sfilter_technical_education_count > 0 ? '<span>'.$sfilter_technical_education_count.'</span>' : null) !!}
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route(Auth::user()->roles[0]->name.'.opportunities.index') }}">
                                <i class="side-menu-icon learnAndGrow-icon"> </i>
                                <div class="side-menu-name">
                                Shared Opportunities
                                </div>
                            </a>
                        </li>
                        <!-- <li>
                            <a href="#">
                                <i class="side-menu-icon announcements-icon"> </i>
                                <div class="side-menu-name">Announcements</div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="side-menu-icon collaborate-icon"> </i>
                                <div class="side-menu-name">
                                Collaborate
                                </div>
                            </a>
                        </li> -->
                    @endhasrole
                    @hasrole('admin')
                        <li class="nav-item">
                            <a href="{{ route(Auth::user()->roles[0]->name.'.events.index') }}" class="{{ (request()->routeIs('admin.events*') ? 'active' : '') }}">
                                <i class="side-menu-icon event-icon"> </i>
                                <div class="side-menu-name">Events</div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route(Auth::user()->roles[0]->name.'.rewards-incentives.index') }}" class="{{ (request()->routeIs('admin.rewards-incentives*') ? 'active' : '') }}">
                                <i class="side-menu-icon event-icon"> </i>
                                <div class="side-menu-name">Rewards & Incentives</div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route(Auth::user()->roles[0]->name.'.offers.index') }}" class="{{ (request()->routeIs('admin.offers*') ? 'active' : '') }}">
                                <i class="side-menu-icon event-icon"> </i>
                                <div class="side-menu-name">Product Promotions & Offers</div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route(Auth::user()->roles[0]->name.'.technical-education.index') }}" class="{{ (request()->routeIs('admin.technical-education*') ? 'active' : '') }}">
                                <i class="side-menu-icon event-icon"> </i>
                                <div class="side-menu-name">Technical Education</div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route(Auth::user()->roles[0]->name.'.users') }}" class="{{ (request()->routeIs('admin.users*') ? 'active' : '') }}">
                                <i class="side-menu-icon event-icon"> </i>
                                <div class="side-menu-name">Users</div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route(Auth::user()->roles[0]->name.'.templatePage') }}" class="{{ (request()->routeIs('admin.templatePage*') ? 'active' : '') }}">
                                <i class="side-menu-icon event-icon"> </i>
                                <div class="side-menu-name">Landing Page</div>

                            </a>
                        </li>
                    @endhasrole
                @endguest
            </ul>
        </div>
        <div class="settings">
            <ul>
                <li>
                    <a href="{{ route(Auth::user()->roles[0]->name.'.home') }}">
                        <img src="{{ asset('public/assets/images/setting-home-icon.svg') }}" alt="" />
                    </a>
                    Home
                </li>
                @hasanyroles(['vendor','partner'])
                    <li>
                        <a href="{{ route(Auth::user()->roles[0]->name.'.user.profile') }}">
                            <img src="{{ asset('public/assets/images/setting-account-icon.svg') }}" alt="" />
                        </a>
                        Account
                    </li>
                @endhasanyroles
                @hasrole('admin')
                    <li>
                        <a href="#">
                            <img src="{{ asset('public/assets/images/setting-account-icon.svg') }}" alt="" />
                        </a>
                        Account
                    </li>
                @endhasrole
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <img src="{{ asset('public/assets/images/setting-logout-icon.svg') }}" alt="" />
                    </a>
                    Logout
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </aside>
    <div class="admin-container-main">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="mobile-header">
                    <button class="aside-Toggle-bar navbar-toggler">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="mobile-header-logo">
                        <a class="logo" href="partnerDashboard.html">
                            <img src="{{ asset('public/assets/images/admin-logo.svg') }}" alt=""/></a>
                    </div>
                </div>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse  justify-content-between" id="navbarSupportedContent">
                    @hasrole('partner')
                    <form id="search-event-form" method="POST" class="my-2 my-lg-0" action="{{route(Auth::user()->roles[0]->name.'.search')}}">
                        @csrf
                        <div class="form-group">
                            <input class="btn-shadow" type="search" name="search_event" id="search_event" value="{{@$txt}}" placeholder="Search" aria-label="Search"/>
                            <div class="inputInnerShadow"></div>
                            <button class="search-icon" type="submit" style="border:none"></button>
                        </div>
                    </form>
                    @endhasrole
                    @hasrole('vendor')
                    <form id="search-event-form" class="my-2 my-lg-0">
                        @csrf
                        <div class="form-group">
                            <input class="btn-shadow" type="search" name="search_event" id="search_event" value="{{@$txt}}" placeholder="Search" aria-label="Search"/>
                            <div class="inputInnerShadow"></div>
                            <div class="search-icon"></div>
                        </div>
                    </form>
                    @endhasrole
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route(Auth::user()->roles[0]->name.'.home') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dashboard
                            </a>
                            <div class="dropdown-menu dashbord-menu" aria-labelledby="navbarDropdown">
                                @hasrole('vendor')
                                    <a class="dropdown-item" href="{{ route(Auth::user()->roles[0]->name.'.events.index') }}">Events</a>
                                    <a class="dropdown-item" href="#">Incentives & Offers</a>
                                    <a class="dropdown-item" href="#">Learn & Grow</a>
                                    <a class="dropdown-item" href="#">Announcements</a>
                                    <a class="dropdown-item" href="#">Collaborate</a>
                                @endhasrole
                                @hasrole('partner')
                                    <a class="dropdown-item" href="{{ route(Auth::user()->roles[0]->name.'.events') }}">Events</a>
                                    <a class="dropdown-item" href="#">Incentives</a>
                                    <a class="dropdown-item" href="#">Promotions</a>
                                    <a class="dropdown-item" href="#">Learn & Grow</a>
                                    <a class="dropdown-item" href="#">Announcements</a>
                                    <a class="dropdown-item" href="#">Collaborate</a>
                                @endhasrole
                                @hasrole('admin')
                                    <a class="dropdown-item" href="{{ route(Auth::user()->roles[0]->name.'.events.index') }}">Events</a>
                                @endhasrole
                            </div>
                        </li>
                        @hasanyroles(['vendor','partner'])
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route(Auth::user()->roles[0]->name.'.user.profile') }}">Account</a>
                            </li>
                        @endhasanyroles
                        @hasrole('admin')
                            <li class="nav-item">
                                <a class="nav-link" href="#">Account</a>
                            </li>
                        @endhasrole
                        <li class="nav-item">
                            <a class="nav-link"  href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
            @hasanyroles(['vendor','partner'])
                <div class="row">
                    <span>Profile completeness level: <span style="color:#e86a6a;">{{Auth::user()->status}}</span></span>
                </div>
            @endhasanyroles
        </header>
        <main class="admin-container">
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    <!-- <script src="{{ asset('public/assets/js/jquery-3.4.1.slim.min.js') }}"></script> -->
    <script src="{{ asset('public/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/bootstrap/bootstrap.min.js') }}"></script>
    
    <!-- <script src="{{ asset('public/assets/js/slimscroll.js') }}"></script> -->
    <!-- <script src="{{ asset('public/js/app.js') }}"></script> -->
    <script src="{{ asset('public/assets/js/select2.full.js') }}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js"></script>
    
    <script src="{{ asset('public/assets/js/fullcalendar-4.4.0/packages/core/main.js') }}"></script>
    <script src="{{ asset('public/assets/js/fullcalendar-4.4.0/packages/interaction/main.js') }}"></script>
    <script src="{{ asset('public/assets/js/fullcalendar-4.4.0/packages/daygrid/main.js') }}"></script>
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @stack('js')
    <script>
        //Right panel over color function 
        $('.aside-Toggle-bar').click(function (e) {
            function lockScroll2() {
                $('.overflowColor').remove();
                $('body').append('<div class="overflowColor"></div>');
                $('body,html,#main-content').addClass('lock-scroll');
            }
            // right filter  scroll
            if ($(window).width() <= 1024) {
            $('aside').toggleClass('aside-opened');
                lockScroll2();
                $('.overflowColor').click(function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $('aside').toggleClass('aside-opened');
                    $('body,html').removeClass('lock-scroll');
                    $('.overflowColor').remove();
                });
            }
        });
        $(function () {
            /* $(document).on('keypress','#search_event',function(event){
                //console.log($(this).val()); return false;
                event.preventDefault();
                var txt_search = $(this).val();
                alert(txt_search);
                if(event.which==13 && txt_search.length > 0){
                    $('#search-event-form').submit();    
                    var evtsrchlink = $(this).data('href');
                    evtsrchlink = evtsrchlink.replace(':txt',txt_search);
                    window.location = evtsrchlink; 
                }
            }); */
            //console.log('hi');
            $("#side-menu li a").click(function() {
            $("#side-menu li a").removeClass("active");
            $(this).addClass("active");
            });
        });
        // left side navigation toggle 
$(".menu-icon").click(function() {
  $(this).toggleClass("menu-highlight");
  $("body").toggleClass("menu-hide");
  $(".edit-profile-panel").toggleClass("edit-profile-show");
  //$( ".content-area" ).toggleClass( "menu-hide" );
});

    </script>


</body>
</html>
