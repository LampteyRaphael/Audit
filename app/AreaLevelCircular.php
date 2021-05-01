<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaLevelCircular extends Model
{
    //
    protected $uploads='/AreaLevelPdf/';
    protected $fillable=[
        'name',
        'area_id',
        'created_at',
        'updated_at'
    ];

    public function getNameAttribute($pdf){
        
        return $this->uploads.$pdf;
    }

    public function area(){

        return $this->belongsTo(Area::class);
    }

}
