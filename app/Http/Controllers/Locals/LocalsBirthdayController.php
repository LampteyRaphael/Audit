<?php

namespace App\Http\Controllers\Locals;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LocalsBirthdayController extends Controller
{
    public function index(){

        $id=Auth::user()->local_id;

        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $day=Carbon::now()->day;

        $users=User::where('local_id',$id)
         ->whereMonth('birthDate',$month)
         ->whereday('birthDate',$day)
         ->get([
             'name',
             'email',
             'photo_id',
             'birthDate',
             'mobileNumber1',
             'mobileNumber2',
             'id'
         ]);

        return view('members.birthday',compact('users'));
    }
    //showing local birthdays
}
