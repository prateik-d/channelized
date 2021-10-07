<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Override the email notification for verifying email
        VerifyEmail::toMailUsing(function ($notifiable){
            $verifyUrl = URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                ['id' => $notifiable->getKey()]
            );

            return (new MailMessage)
                ->subject(Lang::getFromJson('Verify Email Address'))
                ->view('emails.verify-email', [
                    'name' => $notifiable->firstname,
                    'url' => $verifyUrl
                ]);
        });
        
        // Override the email notification for reset email
//        ResetPassword::toMailUsing(function ($notifiable){
//            $resetUrl = url(config('app.url').route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false));
//
//            return (new MailMessage)
//                ->subject(Lang::getFromJson('Reset Password Notification'))
//                ->view('emails.reset-email', [
//                    'url' => $resetUrl
//                ]);
//        });
    }
}
