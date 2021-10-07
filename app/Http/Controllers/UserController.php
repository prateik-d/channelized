<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Jobcategory;
use App\Businesstype;
use App\capabilityPrimary;
use App\capabilitySecondary;
use App\Vendor;
use Crypt, Auth;
use App\Rules\MailRestriction;

class UserController extends Controller
{
    public function index(){
        $users = User::with('roles')->whereHas('roles', function($q){$q->whereIn('name', ['vendor', 'partner']);})->get();
        //dd(Auth::user()->roles[0]->name);
        return view('admin.users', compact('users'));
    }

    public function edit($uid){
        $uid = Crypt::decrypt($uid);
        $user = User::find($uid);
        $jobs = Jobcategory::where('role_id',$user->roles[0]->id)->get();
        $business = null;
        if($user->roles[0]->name=='partner'){
            $business = Businesstype::get();
        }
        $primaries = capabilityPrimary::get();
        $secondaries = null;
        if($user->capability_primary_id){
            $capabilityPrimary = capabilityPrimary::find($user->capability_primary_id);
            $secondaries = $capabilityPrimary->getSecondaryData;
        }
        $vendors = Vendor::get();
        return view('user.edit', compact('user','jobs','business', 'primaries', 'secondaries', 'vendors'));
    }

    public function update($uid=0, Request $request){
        if($uid===0){
            $user = Auth::user();
        }else{
            $uid = Crypt::decrypt($uid);
            $user = User::find($uid);
        }
        //dd($uid, $user, $request->all());

        $this->validate($request, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'companyname' => ['required', 'string', 'max:255'],
            //'email' => ['bail', 'required', 'string', 'email', 'max:255', 'unique:users,email,'.$uid, new MailRestriction],
            /* 'jobtitle' => ['required', 'string', 'max:255'],
            'jobcategory' => ['required', 'integer', 'gt:0'], */
            /* 'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'integer'] */
        ]);

       /*  if($user->roles[0]->name=="partner"){
            $this->validate($request, [
                'businesstype' => ['required']
            ]);
        } */
        
        $data = $request->all();
        $fields = [
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'companyname' => $data['companyname'],
            //'email' => $data['email'],
            /* 'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'post_code' => $data['postcode'] */
        ];

        $intermediate = array();
        $intermediate['jobtitle'] = 0;
        $intermediate['jobcategory'] = 0;
        $intermediate['businesstype'] = 0;

        $advanced = array();
        $advanced['primary'] = 0;
        $advanced['secondary'] = 0;
        $advanced['vendor'] = 0;

        if(isset($data['jobtitle'])){
            $intermediate['jobtitle'] = 1;
            $fields['job_title'] = $data['jobtitle'];
        }
        if(isset($data['jobcategory'])){
            $intermediate['jobcategory'] = 1;
            $fields['job_category_id'] = $data['jobcategory'];
        }
        if(isset($data['primary'])){
            $advanced['primary'] = 1;
            $fields['capability_primary_id'] = $data['primary'];
        }
        if(isset($data['secondary'])){
            $advanced['secondary'] = 1;
            $fields['capability_secondary_id'] = $data['secondary'];
        }
        if(isset($data['vendor'])){
            $advanced['vendor'] = 1;
            $fields['vendor_id'] = $data['vendor'];
        }

        if(isset($data['businesstype'])){
            $fields['business_type_id'] = $data['businesstype'];
            $intermediate['businesstype'] = 1;
            if(!is_numeric($fields['business_type_id'])){
                $fields['business_type_id'] = 0;
                $fields['business_type_other'] = $data['businesstype'];
            }
        }

        $fields['status'] = 'Beginner';
        if(in_array(1, $intermediate) && count(array_unique($intermediate)) === 1){
            $fields['status'] = 'Intermediate';
        }

        if(in_array(1, $intermediate) && count(array_unique($intermediate)) === 1 && in_array(1, $advanced) && count(array_unique($advanced)) === 1){
            $fields['status'] = 'Advanced';
        }

        //dd($fields);

        if($user->update($fields)){
            $data = ['status' => 'success', 'message' => 'user update successfully.'];
        }
        $data = ['status' => 'failed', 'message' => 'Something issue while user update.'];

        if(in_array(Auth::user()->roles[0]->name,['vendor','partner'])){
            return redirect()->route(Auth::user()->roles[0]->name.'.home')->with($data);
        }else{
            return redirect()->route(Auth::user()->roles[0]->name.'.users')->with($data);
        }
    }

    public function changeUserRole($uid, Request $request){
        try {
            $uid = Crypt::decrypt($uid);
            $user = User::where('id', $uid)->first();
            $userrole = Role::where('name', $request->role)->first();
            $user->roles()->sync([$userrole->id]);
            $data = ['status' => 'success', 'message' => "user role successfully changed."];
        } catch (\Exception $e) {
            $data = ['status' => 'failed', 'message' => 'Something issue while change user role.', 'dev' => $e->getMessage()];
        }
        
        return response()->json($data);
    }
    
    public function userProfile(){
        $user = Auth::user();
        $jobs = Jobcategory::where('role_id',$user->roles[0]->id)->get();
        $business = null;
        /* if($user->roles[0]->name=='partner'){ */
            $business = Businesstype::get();
       /*  } */
        $primaries = capabilityPrimary::get();
        $secondaries = null;
        //dd($user->capability_secondary_id);
        if($user->capability_primary_id){
            $secondaries = capabilitySecondary::whereIn('cpid', $user->capability_primary_id)->get();
        }
        //dd($secondaries);
        $vendors = Vendor::get();
        //dd($primaries, $secondaries, $vendors);
        return view('user.edit', compact('user','jobs','business', 'primaries', 'secondaries', 'vendors'));
    }
}
