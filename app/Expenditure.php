<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    //
    protected $fillable=[
        'category_id',
        'local_id',
        'amount',
        'description'
    ];

    public function expenditurecategory(){

        return $this->belongsTo('App\ExpenditureCategory');
    }
}
