<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NationalIncome extends Model
{
    //
    protected $fillable=[
        'category_id',
        'amount',
        'description'
    ];
}
