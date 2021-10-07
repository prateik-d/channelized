<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite, Auth;
use App\User;
use App\Role;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    protected function authenticated(Request $request, $user)
    {
        if (!session('is_verification_call') && !$user->email_verified_at) {
            session(['login.user' => $request->email]);
            auth()->logout();
            return back()->with('email_verification_failed', true);
        }
        
//        if (Auth::user()->roles[0]->name == "admin"){
//            return redirect('admin/home');
//        } else if (Auth::user()->roles[0]->name == "partner"){
//            return redirect('partner/home');
//        } else {
//            return redirect('vendor/home');
//        }
    }

    public function redirectToLinkedin() {
        return Socialite::driver('linkedin')->redirect();
    }

    public function handleLinkedinCallback() {
        try {
            $user = Socialite::driver('linkedin')->user();
            //dd($user);
            $finduser = User::where('linkedin_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/home');
            } else {
                $emlExist = User::where('email', $user->email)->first();
                if($emlExist){
                    $fields = [
                        'linkedin_id' => $user->id,
                        'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ];
                    $emlExist->update($fields);
                    $userrole = Role::where('name', 'partner')->first();
                    $emlExist->roles()->sync([$userrole]);
                    Auth::login($emlExist);
                }else{
                    $fields = [
                        'firstname' => $user->first_name,
                        'lastname' => $user->last_name,
                        'linkedin_id' => $user->id,
                        'email' => $user->email,
                        'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ];
                    $newUser = User::create($fields);
                    $userrole = Role::where('name', 'partner')->first();
                    $newUser->roles()->attach($userrole);
                    Auth::login($newUser);
                }
                return redirect('/home');
            }
        }catch(\Exception $e) {
            return redirect('register');
        }
    }
}
