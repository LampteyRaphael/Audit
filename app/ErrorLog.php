<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    //
    protected $fillable=[
        'local_id',
        'name',
        'details'
    ];

    public function local(){

        return $this->belongsTo('App\Locals');
    }
}
