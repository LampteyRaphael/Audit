<?php

namespace App\Http\Controllers\Individuals;

use App\AreaCircular;
use App\LocalCircular;
use App\Http\Controllers\Controller;
use App\User;
use App\District;
use App\DistrictCircular;
use App\AreaLevelCircular;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class individualCircularController extends Controller
{
    public function index(){

        $month=Carbon::now()->month;
        $year=Carbon::now()->year;
        $post=AreaCircular::whereMonth('created_at',$month)->whereYear('created_at',$year)->orderBy('created_at','desc')->get();
        return view('individual.circular',compact('post','month','year'));
    }

    public function store(Request $request){
        $month=$request['month'];
        $year=$request['year'];
        $post=AreaCircular::orderBy('created_at','desc')->whereMonth('created_at',$month)->whereYear('created_at',$year)->orderBy('created_at','desc')->get();
        return view('individual.circular',compact('post','month','year'));
    }


    public function showPdf($id)
    {
        $post=AreaCircular::where('id',$id)->get();
        return view('individual.circularshow',compact('post'));
    }


    public function tolocal(){
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;
        $post=LocalCircular::where('local_id',Auth::user()->local_id)->whereMonth('created_at',$month)->whereYear('created_at',$year)
            ->orderBy('created_at','desc')->get();
        return view('individual.localAnnouncement',compact('post','month','year'));
    }

    public function tolocalshow($id)
    {
        $local_id= Auth::user()->local_id;
        $posts=LocalCircular::where('id',$id)->where('local_id',$local_id)->first();
        
        if($posts==[]){
            return redirect()->route('tolocalAnnouncement')->withError('Local Circular not found by ID ' .$id)->withInput();
        }
        else{
            $post=LocalCircular::where('id',$id)->where('local_id',$local_id)->get();
         }  
        return view('individual.circularshow',compact('post'));
    }

    public function store2(Request $request){
        $month=$request['month'];
        $year=$request['year'];
        $post=LocalCircular::where('local_id',Auth::user()->local_id)
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->orderBy('created_at','desc')->get();

        return view('individual.localAnnouncement',compact('post','month','year'));
    }



    public function district()
    {
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;
        $area_id=Auth::user()->area_id;
        
        $district_id=District::where('area_id',$area_id)->pluck('id');

        $post=DistrictCircular::whereIn('district_id',$district_id)->whereYear('created_at',$year)->whereMonth('created_at',$month)->get();

        return view('individual.district',compact('year','month','post'));

    }

    public function districtPost(Request $request)
    {
        $month=$request['month'];
        $year=$request['year'];
        $area_id=Auth::user()->area_id;
        
        $district_id=District::where('area_id',$area_id)->pluck('id');

        $post=DistrictCircular::whereIn('district_id',$district_id)->whereYear('created_at',$year)->whereMonth('created_at',$month)->get();

        return view('individual.district',compact('year','month','post'));

    }


    public function districtshow($id)
    {
        $area_id=Auth::user()->area_id;
        
        $district_id=District::where('area_id',$area_id)->pluck('id');

        $posts=DistrictCircular::where('id',$id)->where('district_id',Auth::user()->district_id)->first();
        
        if($posts==[]){
            return redirect()->route('APCircularGetD')->withError('District not found by ID ' .$id)->withInput();
        }
        else{
            $post=DistrictCircular::where('id',$id)->where('district_id',Auth::user()->district_id)->get();
         }   
         return view('individual.circularshow',compact('post'));
    }



    public function area()
    {
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;
        $post=AreaLevelCircular::whereMonth('created_at',$month)->whereYear('created_at',$year)->where('area_id',Auth::user()->area_id)->orderBy('created_at','desc')->get();
     
         return view('individual.area',compact('post','month','year'));
    }


    public function areashow($id)
    {
    // try{
        $posts=AreaLevelCircular::where('id',$id)->where('area_id',Auth::user()->area_id)->first();
        
        if($posts==[]){
            return redirect()->route('waiting.create')->withError('Area not found by ID ' .$id)->withInput();
        }
        else{
            $post=AreaLevelCircular::where('id',$id)->where('area_id',Auth::user()->area_id)->get();
         }   
         return view('individual.circularshow',compact('post'));
    }

        


    public function areaPost(Request $request)
    {
         //calling announcement from the area level
         $year=$request['year'];
         $month=$request['month'];
         $post=AreaLevelCircular::whereMonth('created_at',$month)->whereYear('created_at',$year)->where('area_id',Auth::user()->area_id)->orderBy('created_at','desc')->get();

         return view('individual.area',compact('post','month','year','month','year'));
    }



public function birthdayDaily()
{
    $id=Auth::user()->local_id;
    $month=Carbon::now()->month;
    $day=Carbon::now()->day;
    $users=User::where('local_id',$id)->whereMonth('birthDate',$month)->whereday('birthDate',$day)->get([
         'name',
         'email',
         'photo_id',
         'birthDate',
         'mobileNumber1',
         'mobileNumber2',
         'id'
     ]);

    return view('individual.birthdayDaily',compact('users'));
}

public function birthdayMonth()
{
    $id=Auth::user()->local_id;
    $month=Carbon::now()->month;
    $users=User::where('local_id',$id)->whereMonth('birthDate',$month)->get([
         'name',
         'email',
         'photo_id',
         'birthDate',
         'mobileNumber1',
         'mobileNumber2',
         'id'
     ]);

    return view('individual.birthdayMonth',compact('users'));
}



public function profile()
{
    $id=Auth::user()->id;
    $user=User::whereId($id)->firstOrFail();
    return view('individual.details',compact('user'));

}

    public function store3(){

        return view('individual.resetp');
    }

//    public function store4(Request $request){
//
//        $password=$request->all();
//
//
//        if (Hash::make($password['password'])==Auth::user()->password){
//
//
////            return redirect()->back()->with(['success1'=>'Password Successfully Updated']);
//
//            return response()->json(['errors' => ['Your current password can\'t be with new password']], 400);
//        }else{
//            return redirect()->back()->with(['success1'=>'Password Successfully Updateds']);
//
//        }
//
////        $count=User::where('password',$password['password']);
//
////        return $count->count();
//
//
//    }





}
