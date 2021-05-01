<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTithe extends Model
{
    //
    protected $fillable=[
        'user_id',
        'local_id',
        'amount',
        'modeOfPayment',
        'dateOfCheque',
        'checkNo',
        'bank'
    ];

    public function user(){
        return  $this->belongsTo(User::class);
    }

    public function local(){
        return $this->belongsTo(Locals::class);
    }

}
