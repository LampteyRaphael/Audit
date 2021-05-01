<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NationalExpenditure extends Model
{
    //national expenditure
    protected $fillable=[
        'category_id',
        'amount',
        'description'
    ];
}
