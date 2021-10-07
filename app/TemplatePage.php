<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class TemplatePage extends Model
{
    //

    protected $table = 'page_template_master';
    // public $timestamps = true;

    // protected $casts = [
    //     'price' => 'float'
    // ];

    protected $fillable = [
        'title',
        'content',
        'owner',
        'created_by',
        'deleted',
        'created_at'
    ];
}
