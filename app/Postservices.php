<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postservices extends Model
{
    //
    protected $fillable=[
        'generatedfund',
        'amount',
        'local_id'
    ];
}
