<?php

namespace App\Http\Controllers\Locals;

use App\AreaLevelCircular;
use App\DistrictCircular;
use App\Http\Controllers\Controller;
use App\LocalCircular;
use App\Locals;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostDistrictToLocalCircularController extends Controller
{
    //
    public function index(){
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;

        $id=Auth::user()->district_id;

        $districtName=Auth::user()->district->name;

        $post=DistrictCircular::where('district_id',$id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->orderBy('created_at','desc')->get();

        return view('members.districtCircular',compact('post','districtName','year','month'));
    }

    public function indexpost(Request $request){
        $month=$request['month'];
        $year=$request['year'];
        $id=Auth::user()->district_id;

        $districtName=Auth::user()->district->name;
        $post=DistrictCircular::where('district_id',$id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->orderBy('created_at','desc')->take(10)->get();

        return view('members.districtCircular',compact('post','districtName','month','year'));
    }

    public function store(Request $request){
        $month=$request['month'];
        $year=$request['year'];
        $id=Auth::user()->local_id;
        $post=LocalCircular::where('local_id',$id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->orderBy('created_at','desc')->take(5)->get();

        $local=Auth::user()->local->name;

        return view('members.circular',compact('post','local','year','month'));
    }

    public function localPost(){

        return view('members.localCreate');
    }


    public function area()
    {
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;

        $id=Auth::user()->area_id;
        $areaName=Auth::user()->area->name;

        $post=AreaLevelCircular::where('area_id',$id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->orderBy('created_at','desc')->get();

        return view('members.areaCircular',compact('month','year','post','areaName'));
    }

    public function areaPost(Request $request)
    {
        $month=$request['month'];
        $year=$request['year'];

        $id=Auth::user()->area_id;
        $areaName=Auth::user()->area->name;

        $post=AreaLevelCircular::where('area_id',$id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->orderBy('created_at','desc')->get();

        return view('members.areaCircular',compact('month','year','post','areaName'));
    }


    public function areashow($id)
    {
        try {
            $post=AreaLevelCircular::where('id',$id)->where('area_id',Auth::user()->area_id)->get();

        }catch (ModelNotFoundException $exception){

            return back()->withError('Local not found by ID ' . $id)->withInput();
        }
        return view('members.showsPdf',compact('post'));
    }

}
