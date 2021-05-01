<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostSunday extends Model
{
    //
    protected $fillable=
        [
    'offering',
    'tithe',
    'donation',
    'envelop',
    'fundraising',
    'typeofevent',
     'local_id',
    ];
}
