<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class income extends Model
{
    //
    protected $fillable=[
        'category_id',
        'local_id',
        'amount',
        'description'
    ];
}
