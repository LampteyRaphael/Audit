<?php

namespace App\Http\Controllers\District;

use App\AreaCircular;
use App\AreaLevelCircular;
use App\Http\Controllers\Controller;
use App\LocalCircular;
use App\Locals;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Compound;

class DistrictPdfController extends Controller
{
    //
    public  function __construct()
    {
        date_default_timezone_set("Africa/Accra");
    }

    public function index(Request $request){

        $month=$request['month'];
        $year=$request['year'];
        $post=AreaCircular::orderBy('created_at','desc')
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->orderBy('created_at','desc')->get();

        return view('districts.circular',compact('post','month','year'));
    }


    public  function area(){

        $month=Carbon::now()->month;
        $year=Carbon::now()->year;
        $area_id=Auth::user()->area_id;

        $post=AreaLevelCircular::where('area_id',$area_id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->get();

       return view('districts.areaCircular',compact('post','year','month'));
    }


    public function areaPost(Request $request){

        $month=$request['month'];
        $year=$request['year'];
        $area_id=Auth::user()->area_id;

        $post=AreaLevelCircular::where('area_id',$area_id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->get();

        return view('districts.areaCircular',compact('post','year','month'));
    }



    public function areaShow($id){

        $area_id=Auth::user()->area_id;

        $post=AreaLevelCircular::where('area_id',$area_id)->where('id',$id)
            ->get();

        return view('districts.showCircular',compact('post'));
    }



    public function locals(){
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;
        $districtId=Auth::user()->district_id;

        $localId=Locals::where('district_id',$districtId)->pluck('id');
        $post=LocalCircular::whereIn('local_id',$localId)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->get();

       return view('districts.localsCircular',compact('post','year','month'));
    }




    public function localsPost(Request $request){
        $month=$request['month'];
        $year=$request['year'];
        $districtId=Auth::user()->district_id;
        $localId=Locals::where('district_id',$districtId)->pluck('id');
        $post=LocalCircular::whereIn('local_id',$localId)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->get();

        return view('districts.localsCircular',compact('post','year','month'));

    }

    public function localsShow($id){
        $districtId=Auth::user()->district_id;

        $localId=Locals::where('district_id',$districtId)->pluck('id');

        $post=LocalCircular::whereIn('local_id',$localId)->where('id',$id)->get();

        if(emptyArray($post)){

          return redirect()->route('districtCirLocals')->withError('District not found by ID ' .$id)->withInput();

        }else{
//            $post=LocalCircular::whereIn('local_id',$localId)->where('id',$id)->get();

            return view('districts.showCircular',compact('post'));
        }



    }




}
