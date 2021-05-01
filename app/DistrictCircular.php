<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistrictCircular extends Model
{
    protected $uploads='/DistrictPdf/';
    //district circular
    protected $fillable=[
        'name','district_id'
    ];


    public function getNameAttribute($pdf){

        return $this->uploads.$pdf;
    }
    
    public function district(){

        return $this->belongsTo(District::class);
    }
}
