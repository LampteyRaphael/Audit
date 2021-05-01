<?php

namespace App\Http\Controllers\Locals;

use App\Http\Controllers\Controller;
use App\PostTithe;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowIndividualTitheAtLocalController extends Controller
{
    //
    public function index($id){
       try{
        $local_id=Auth::user()->local_id;

        $tithe=PostTithe::where('local_id',$local_id)
            ->where('user_id',$id)
            ->whereYear('created_at',Carbon::now()->year)->get();

        $total=PostTithe::where('local_id',$local_id)
            ->where('user_id',$id)->whereYear('created_at',Carbon::now()->year)->pluck('amount')->sum();
          }catch (ModelNotFoundException $exception){

                  return back()->withError('User not found by ID ' . $id)->withInput();
                }

        return view('locals.tithe',compact('tithe','total'));
    }

    public function index2(Request $request){

        $authId=Auth::user()->local_id;
        $year=Carbon::parse($request['date'])->year;
        $month=Carbon::parse($request['date'])->month;
        $day=Carbon::parse($request['date'])->day;

        $date=Carbon::parse($request['date'])->format('jS F,Y');
        $tithe=PostTithe::where('local_id',$authId)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)->get();

        $totalTithe=PostTithe::where('local_id',$authId)
            ->whereDay('created_at',$day)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->pluck('amount')->sum();
        return view('members.tithe.index',compact('tithe','totalTithe','date'));
    }
}
