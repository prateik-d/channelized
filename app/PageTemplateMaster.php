<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageTemplateMaster extends Model
{
    protected $table = 'template_page_master';
    
    protected $fillable = [
        'name',
        'content',
        'owner',
        'created_by',
        'deleted',
        'filepath',
        'created_at',
        'updated_at'
    ];
}
