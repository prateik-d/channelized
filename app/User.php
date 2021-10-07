<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'companyname', 'email', 'job_title', 'job_category_id', 'business_type_id', 'password', 'address', 'city', 'state', 'post_code', 'business_type_other', 'is_active', 'linkedin_id', 'email_verified_at', 'step', 'status', 'capability_primary_id', 'capability_secondary_id', 'vendor_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'capability_primary_id' => 'array',
        'capability_secondary_id' => 'array',
    ];
    
    
    public function getFullnameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }
    
    public function roles(){
        return $this->belongsToMany('App\Role');
    }
    
    // check user roles
    public function hasCheckAnyRoles($roles){
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    
    // check user role
    public function hasAnyRole($role){
        return null !== $this->roles()->where('name', $role)->first();
    }
    
    public function getRole(){
        return implode(',',$this->roles()->get()->pluck('name')->toArray());
    }
    
    public function getPartnerFilter(){
        return $this->hasMany('App\PartnerFilter');
    }
    
    public function getUserEventShortlist(){
        return $this->hasMany('App\PartnerEventCount')->where('short_list',1)->where('user_id', '!=', 0);
    }

    public function getUserEvents($category = ''){
        return $this->hasMany('App\Event','added_by','id')->where('is_deleted',0)->where('category',$category);
    }
}
