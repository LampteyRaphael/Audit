<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NationalIncomeCategory extends Model
{
    //creating income category
    protected $fillable=[
        'name'
    ];

    public function setNameAttribute($value)
    {

        return $this->attributes['name']=strtoupper($value);

    }
}
