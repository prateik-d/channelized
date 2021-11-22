<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandingPageUserEmail extends Model
{
    protected $table = 'landing_page_user_email';
    
    protected $fillable = [
        'id',
        'user_id',
        'template_id',
        'email',
        'created_at',
        'updated_at'
    ];
}
