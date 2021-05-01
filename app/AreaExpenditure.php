<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaExpenditure extends Model
{
    //
    protected $fillable=[
        'area_income_categories_id',
        'area_id',
        'amount',
        'description',
        'created_at',
    ];

    public function category(){

        return $this->belongsTo(AreaExpenditureCategory::class);
    }
}
