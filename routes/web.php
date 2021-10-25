<?php
use App\Helpers;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $events = Helper::get_home_page_events('event');
    $reward_incentives = Helper::get_home_page_events('reward_incentive');
    $technical_educations = Helper::get_home_page_events('technical_education');
    $product_promotion_offer = Helper::get_home_page_events('product_promotion_offer');
    //dd($events, $reward_incentives, $technical_educations);
    return view('welcome', compact('events', 'reward_incentives', 'technical_educations', 'product_promotion_offer'));
});

Auth::routes(['register' => false, 'verify' => true]);

Route::get('register', 'Auth\RegisterController@showRegistrationPlan')->name('register_plan');
Route::get('register/{type?}', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::post('register_work', 'Auth\RegisterController@register_work_mail')->name('register_work');
Route::get('auth/linkedin', 'Auth\LoginController@redirectToLinkedin')->name('auth/linkedin');
Route::get('auth/linkedin/callback', 'Auth\LoginController@handleLinkedinCallback');
Route::post('secondary_data', 'HomeController@secondary_data')->name('secondary_data');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

/**
 * Google OAuth2 route demo
 */
Route::resource('gcalendar', 'gCalendarController');
Route::get('demooauthCallback', ['as' => 'demooauthCallback', 'uses' => 'gCalendarController@oauth']); 
Route::get('oauth', ['as' => 'oauthCallback', 'uses' => 'googleCalendarSync@oauth']);
Route::get('gcalendar_sync/{id}','googleCalendarSync@syncadd')->name('gcalendar_sync');

/**
 * Outlook OAuth2 route demo
 */
Route::get('outlook_signin', 'OutlookCalendarSync@signin')->name('outlook_signin');
Route::get('outlook_callback', 'OutlookCalendarSync@callback')->name('outlook_callback');
Route::get('outlook_calendar_sync/{id}', 'OutlookCalendarSync@calendar_sync')->name('outlook_calendar_sync');

Route::prefix('admin')->middleware(['auth','auth.admin'])->name('admin.')->group(function(){ 
    Route::get('home', 'HomeController@admin')->name('home');
    /* Route::resource('events','EventController', ['except'=>['show']]); */
    /* Route::get('event/{id}','EventController@admin_event_view')->name('event.view'); */
    Route::get('events','EventController@admin_events')->name('events.index');
    Route::get('rewards-incentives','RewardsIncentivesController@admin_rewards_incentives')->name('rewards-incentives.index');
    Route::get('offers','OffersController@offers_events')->name('offers.index');
    Route::get('technical-education','TechnicalEducationController@admin_technical_education')->name('technical-education.index');
    Route::put('events_update/{id}', 'EventController@update')->name('events.update');
    Route::get('events/{id}','EventController@admin_event_edit')->name('events.edit');
    Route::get('rewards-incentives/{id}','RewardsIncentivesController@admin_rewards_incentives_edit')->name('rewards-incentives.edit');
    Route::put('rewards_incentives_update/{id}','RewardsIncentivesController@update')->name('rewards-incentives.update');
    Route::get('offers/{id}','OffersController@admin_offer_edit')->name('offers.edit');
    Route::put('offers_update/{id}','OffersController@update')->name('offers.update');
    Route::get('technical-education/{id}','TechnicalEducationController@admin_technical_education_edit')->name('technical-education.edit');
    Route::put('technical_education_update/{id}','TechnicalEducationController@update')->name('technical-education.update');
    Route::post('event_status/{id}','EventController@admin_event_status')->name('event.status');
    Route::get('users', 'UserController@index')->name('users');
    Route::post('users/role/{uid}', 'UserController@changeUserRole')->name('users.role');
    Route::get('users/edit/{uid}', 'UserController@edit')->name('users.edit');
    Route::put('users/update/{uid}', 'UserController@update')->name('users.update');
    Route::get('user/profile','UserController@userProfile')->name('user.profile');
    
    Route::get('template', 'PageTemplateController@index')->name('templatePage');
    Route::get('template/deactivate/{id}', 'PageTemplateController@deactivate')->name('templatePage.deactivate');
    Route::get('template/inactivate/{id}', 'PageTemplateController@inactivate')->name('templatePage.inactivate');
    Route::get('template/deactivated/', 'PageTemplateController@deactivated')->name('templatePage.deactivated');
    // Route::get('template/create', 'TemplatePageController@create')->name('templatePage.create');
    // Route::post('template/create', 'TemplatePageController@create')->name('templatePage.create');
    // Route::get('template/view/{id}', 'TemplatePageController@show')->name('templatePage.show');
    // Route::get('template/edit/{uid}', 'TemplatePageController@edit')->name('templatePage.edit');
    // Route::post('template/update', 'TemplatePageController@update')->name('templatePage.update');
    // Route::get('template/delete/{id}', 'TemplatePageController@destroy')->name('templatePage.delete');
    // Route::get('template/deleted/', 'TemplatePageController@deleted')->name('templatePage.deleted');
    // Route::get('template/restore/{id}', 'TemplatePageController@restore')->name('templatePage.restore');
});

Route::post('events/{event}','EventController@partner_event_readmore')->name('events.readmore');
Route::post('event/{event}','EventController@partner_event_viewagenda')->name('event.view');

Route::prefix('partner')->middleware(['auth','auth.partner'])->name('partner.')->group(function(){
    Route::get('home', 'HomeController@partner')->name('home');
//    Route::resource('events','EventController', ['except'=>['show']]);
    Route::match(['get', 'post'], 'events', 'EventController@partner_events')->name('events');

    Route::post('search','EventController@globalSearch')->name('search');

    Route::get('events_calender','EventController@partner_events_calender')->name('events.calender');
    Route::post('events_filter','EventController@partner_filter_store')->name('events.store');
    /* Route::get('event/{txt}','EventController@partner_event_search')->name('event.search'); */
    Route::delete('events/{event}','EventController@partner_filter_destroy')->name('events.destroy');
    Route::post('events/{event}/{shortlist}','EventController@partner_event_shortlist')->name('events.shortlist');
    Route::post('events/{event}','EventController@partner_event_readmore')->name('events.readmore');
    Route::post('event/{event}','EventController@partner_event_viewagenda')->name('event.view');
    
    Route::post('filter_event','EventController@partner_event_filter')->name('event.filter');

    Route::match(['get'], 'rewards-incentives-calender', 'RewardsIncentivesController@partner_rewards_incentives_calender')->name('rewards-incentives.calender');
    Route::match(['get'], 'rewards-incentives', 'RewardsIncentivesController@partner_rewards_incentives')->name('rewards-incentives');
    Route::post('rewards_incentives_filter','RewardsIncentivesController@partner_filter_store')->name('rewards_incentives.store');
    Route::post('filter_incentives','RewardsIncentivesController@partner_rewards_incentives_filter')->name('incentives.filter');

    Route::match(['get'], 'product-promotions-offers-calender', 'OffersController@partner_product_promotions_offers_calender')->name('product-promotions-offers.calender');
    Route::match(['get'], 'product-promotions-offers', 'OffersController@partner_product_promotions_offers')->name('product-promotions-offers');
    Route::post('product_promotions_offers_filter','OffersController@partner_filter_store')->name('product_promotions_offers.store');
    Route::post('filter_offers','OffersController@partner_product_promotions_offers_filter')->name('offers.filter');

    Route::resource('opportunities','OpportunitiesController');

    Route::match(['get'], 'technical-education-calender', 'TechnicalEducationController@partner_technical_education_calender')->name('technical-education.calender');
    Route::match(['get'], 'technical-education', 'TechnicalEducationController@partner_technical_education')->name('technical-education');
    Route::post('technical_education_filter','TechnicalEducationController@partner_filter_store')->name('technical_education.store');
    Route::post('filter_technical_education','TechnicalEducationController@partner_technical_education_filter')->name('technical_education.filter');

    Route::get('user/profile','UserController@userProfile')->name('user.profile');
    Route::put('user/update', 'UserController@update')->name('user.update');

    Route::get('template', 'PageTemplateController@partner_index')->name('ptemplatePage');
    Route::post('template/added', 'PageTemplateController@partner_added')->name('ptemplatePage.added');
    Route::get('template/create/{id}', 'PageTemplateController@partner_create')->name('ptemplatePage.create');
    Route::get('template/view/{id}', 'PageTemplateController@partner_show')->name('ptemplatePage.show');
    Route::post('template/logo_upload', 'PageTemplateController@partner_logo_upload')->name('ptemplatePage.logo_upload');
    Route::post('template/logo_upload_edit', 'PageTemplateController@partner_logo_upload_edit')->name('ptemplatePage.logo_upload_edit');
    Route::get('template/edit/{uid}', 'PageTemplateController@partner_edit')->name('ptemplatePage.edit');
    Route::post('template/edit', 'PageTemplateController@partner_update')->name('ptemplatePage.update');
});

Route::prefix('vendor')->middleware(['auth','auth.vendor'])->name('vendor.')->group(function(){
    Route::get('home', 'HomeController@vendor')->name('home');
    Route::post('event/getdata','EventController@userwise_impression')->name('event.getdata');

    Route::resource('events','EventController');
    Route::resource('rewards-incentives','RewardsIncentivesController', ['except'=>['show']]);
    Route::resource('offers','OffersController', ['except'=>['show']]);
    Route::resource('technical-education','TechnicalEducationController', ['except'=>['show']]);
    Route::get('event_success/{category}','EventController@event_success_info')->name('evnet.info');

    //Route::get('events/create/{type}','EventController@create')->name('events.create');
    //Route::get('rewards-incentives/create/{type}','RewardsIncentivesController@create')->name('rewards-incentives.create');
    //Route::get('offers/create/{type}','OffersController@create')->name('offers.create');
    //Route::get('technical-education/create/{type}','TechnicalEducationController@create')->name('technical-education.create');

    Route::get('event/{txt}','EventController@vendor_event_search')->name('event.search');
    Route::get('event/profile/{id}','EventController@vendor_event_profile')->name('event.profile');
    Route::get('user/profile','UserController@userProfile')->name('user.profile');
    Route::put('user/update', 'UserController@update')->name('user.update');

    Route::get('template', 'PageTemplateController@vendor_index')->name('vtemplatePage');
    Route::post('template/added', 'PageTemplateController@vendor_added')->name('vtemplatePage.added');
    Route::get('template/create/{id}', 'PageTemplateController@vendor_create')->name('vtemplatePage.create');
    Route::get('template/view/{id}', 'PageTemplateController@vendor_show')->name('vtemplatePage.show');
    Route::post('template/logo_upload', 'PageTemplateController@vendor_logo_upload')->name('vtemplatePage.logo_upload');
    Route::post('template/logo_upload_edit', 'PageTemplateController@vendor_logo_upload_edit')->name('vtemplatePage.logo_upload_edit');
    Route::get('template/edit/{uid}', 'PageTemplateController@vendor_edit')->name('vtemplatePage.edit');
    Route::post('template/edit', 'PageTemplateController@vendor_update')->name('vtemplatePage.update');
    Route::get('template/delete/{id}', 'PageTemplateController@vendor_deactivate')->name('vtemplatePage.deactivate');
});