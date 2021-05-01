<?php

namespace App\Http\Controllers\District;

use App\Http\Controllers\Controller;
use App\PostCircularForDistrictAdmins;
use Illuminate\Http\Request;

class OnlyAdminsController extends Controller
{
    //
    public function index(){

        $post=PostCircularForDistrictAdmins::orderBy('created_at','desc')->get()->take(10);

        return view('districts.onlyadminscircular',compact('post'));
    }
}
