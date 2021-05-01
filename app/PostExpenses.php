<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostExpenses extends Model
{
    //
    protected $fillable=[
        'expenditureCategory',
        'amount',
        'local_id'
    ];
}
