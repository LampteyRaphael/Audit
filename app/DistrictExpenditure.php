<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistrictExpenditure extends Model
{
    //
    protected $fillable=[
        'district_income_categories_id',
        'district_id',
        'amount',
        'description',
        'created_at',
    ];
}
