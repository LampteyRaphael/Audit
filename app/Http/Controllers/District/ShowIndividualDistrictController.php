<?php

namespace App\Http\Controllers\District;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowIndividualDistrictController extends Controller
{
    //showing individual at the district level

    public function index($id){

   try{
        $user=User::here('id',$id)->where('district_id',Auth::user()->district_id)->firstOrFail();

    }catch (ModelNotFoundException $exception) {

    return back()->withError('User not found by ID ' . $id)->withInput();

    }
        return view('districts.showIndividual',compact('user'));
    }

}
