<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Auth;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // check login user role
        Blade::if('hasrole', function($expression){
            if(Auth::user()){
                if(Auth::user()->hasAnyRole($expression)){
                    return true;
                }
            }
            return false;
        });
        
        Blade::if('hasanyroles', function($expression){
            if(Auth::user()){
                if(Auth::user()->hasCheckAnyRoles($expression)){
                    return true;
                }
            }
            return false;
        });
    }
}
