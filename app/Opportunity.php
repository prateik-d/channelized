<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    //protected $table = 'opportunities';

    protected $fillable = ['user_id','have_project', 'agreement', 'project_about', 'vendor', 'solution_category', 'certification', 'project_time', 'service_time', 'budget', 'amount', 'location', 'city'];
}
