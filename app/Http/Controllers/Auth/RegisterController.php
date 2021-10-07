<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Businesstype;
use App\Jobcategory;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Rules\MailRestriction;
use Session;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/email/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        
        $validation_fields = [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'companyname' => ['required', 'string', 'max:255'],
            'email' => ['bail', 'required', 'string', 'email', 'max:255', 'unique:users', new MailRestriction],
            /* 'jobtitle' => ['required', 'string', 'max:255'],
            'jobcategory' => ['required', 'integer', 'gt:0'], */
            'password' => ['bail', 'required', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)|(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*])|(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*])|(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).+$/', 'confirmed'],
            /* 'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'integer'], */
            /* 'plan_type' => ['required', 'exists:roles,name'] */
        ];
        
        $validation_fields_msg = [
            /* 'jobcategory.gt' => 'Please select any Job category', */
            /* 'plan_type.exists' => 'Something is wrong. Please try after sometime.' */
        ];
        
        /* if($data['plan']=="partner"){
            $validation_fields['businesstype'] = ['required'];
            $validation_fields_msg['businesstype.gt'] = "Please select any Business type";
        } */
        
        return Validator::make($data, $validation_fields, $validation_fields_msg);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $fields = [
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'companyname' => $data['companyname'],
            'email' => $data['email'],
            /* 'job_title' => $data['jobtitle'],
            'job_category_id' => $data['jobcategory'], */
            'password' => Hash::make($data['password']),
            /* 'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'post_code' => $data['postcode'] */
        ];
        
        /* if($data['plan']=="partner"){
            $fields['business_type_id'] = $data['businesstype'];
            if(!is_numeric($fields['business_type_id'])){
                $fields['business_type_id'] = 0;
                $fields['business_type_other'] = $data['businesstype'];
            }
        } */
        return User::create($fields);
    }
    
    public function showRegistrationPlan()
    {
        $plans = Role::where('name', '!=', 'admin')->get();
        return view('auth.register_plan', compact('plans'));
    }
    
    public function showRegistrationForm($plan)
    {
        //,'vendor'
        if(!in_array($plan, ['manually'])){ die('something is wrong'); }
        $cmpnm = (Input::old('companyname') ? Input::old('companyname') : Session::get('cmpnm'));
        $email = (Input::old('email') ? Input::old('email') : Session::get('email'));
        //$plan = (Input::old('plan_type') ? Input::old('plan_type') : Session::get('plan'));
        //dd(Input::old());
        /* $plandb = Role::where('name',$plan)->first(); */
        /* $jobs = Jobcategory::where('role_id',$plandb->id)->get(); */
        /* $business = null;
        if($plan=='partner'){
            $business = Businesstype::get();
        } */
        
        if(empty($email) || empty($plan)){
            return redirect()->route('register');
        }

        return view('auth.register', compact('cmpnm', 'email')); //, 'plan' compact('jobs','business','plan')
    }
    
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        
        $userrole = Role::where('name', $request->plan_type)->first();
        $user->roles()->attach($userrole);
//        $this->guard()->login($user);

        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }
    
    protected function registered(Request $request, $user)
    {
        session(['login.user' => $request->email]);
        redirect($this->redirectPath());
    }

    public function register_work_mail(Request $request){
        $request->validate([
            'work_email' => ['bail', 'required', 'string', 'email', 'max:255', 'unique:users,email', new MailRestriction],
            //'type' => ['bail', 'required', 'in:partner,vendor']
        ],[
            //'type.*' => "Please select account type"
        ]);
        //dd($request->all());
        $emailDiv = explode('@',$request->work_email);
        $work = end($emailDiv);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://autocomplete.clearbit.com/v1/companies/suggest?query=".$work,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: 803dacc7-c70c-0a41-8347-a79b73167639"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $cmpnm = null;
        if (!$err) {
            /* echo "cURL Error #:" . $err;
            die();
        } else { */
            $res = json_decode($response);
            if($res){
                $cnmindex = array_search($work, array_column($res,'domain'));
                if($cnmindex >= 0){
                    $cmpnm = $res[$cnmindex]->name;
                }
            }
        }
        return redirect('register/manually')->with(['cmpnm' => $cmpnm, 'email' => $request->work_email]); //, 'plan' => $request->type
    }
}