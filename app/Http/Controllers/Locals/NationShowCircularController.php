<?php

namespace App\Http\Controllers\Locals;

use App\AreaCircular;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
class NationShowCircularController extends Controller
{
    //showing circular from nation to local level

    public function index(){

        $day=Carbon::now()->day;
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;

        $post=AreaCircular::orderBy('created_at','desc')
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->get();

        return view('members.show',compact('post','month','year'));
    }

    public function indexpost(Request $request){

        $month=$request['month'];
        $year=$request['year'];

        $post=AreaCircular::orderBy('created_at','desc')
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->get();

        return view('members.show',compact('post','month','year'));
    }


    public function download($id)
    {
        $post=AreaCircular::where('id',$id)->get();
        return view('members.showsPdf',compact('post'));
    }

}
