<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
    protected $fillable=[
        'local_id',
        'talley',
        'category',
        'ministers',
        'elders',
        'deacon',
        'deaconess',
        'male',
        'female',
        'children',
        'visitors',
        'created_at'
    ];
}
