<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationAndPledge extends Model
{
    //
    protected $fillable=[
        'user_id',
        'local_id',
        'amount',
        'modeOfPayment',
        'dateOfCheque',
        'checkNo',
        'bank',
        'donationOrPledge'
    ];

    public function user(){

        return $this->belongsTo('App\User');
    }

    public function local(){

        return $this->belongsTo('App\Locals');
    }
}
