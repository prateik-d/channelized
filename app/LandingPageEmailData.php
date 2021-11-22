<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandingPageEmailData extends Model
{
    protected $table = 'landing_page_email_data';
    
    protected $fillable = [
        'id',
        'user_id',
        'template_id',
        'first_name',
        'last_name',
        'email',
        'company',
        'created_at',
        'updated_at'
    ];
}
