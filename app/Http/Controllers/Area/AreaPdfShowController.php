<?php

namespace App\Http\Controllers\Area;

use App\Area;
use App\AreaCircular;
use App\AreaLevelCircular;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DistrictCircular;
use App\District;
use App\LocalCircular;
use App\Locals;
use Carbon\Carbon;
use FontLib\Table\Type\post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use League\Flysystem\Adapter\Local;

class AreaPdfShowController extends Controller
{
    public function nationalshow($id)
    {
        $post=AreaCircular::where('id',$id)->get();
        return view('area.circular.national',compact('post'));

    }

    public function store(Request $request)
    {
        //creating local messages
        $input =$request->all();

        if ($file=$request->file('name')){

            $name=time().$file->getClientOriginalName();

            $file->move('AreaLevelPdf',$name);

            AreaLevelCircular::create(['name'=>$name,'area_id'=>$request['area_id']]);
        }

        return redirect()->back()->with(['success1'=>'Successfully Posted Circular to Locals']);

    }


    public function create()
    {
        return view('area.circular.create');
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
         return view('area.circular.national',compact('post'));
    }

        


    public function areaPost(Request $request)
    {
         //calling announcement from the area level
         $year=$request['year'];
         $month=$request['month'];

         $post=AreaLevelCircular::whereMonth('created_at',$month)->whereYear('created_at',$year)->where('area_id',Auth::user()->area_id)->orderBy('created_at','desc')->get();

         return view('area.areaCircular',compact('post','month','year','month','year'));
    }


    public function local()
    {
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;
        $area_id=Auth::user()->area_id;
        
        $district_id=District::where('area_id',$area_id)->pluck('id');

        $local_id= Locals::whereIn('district_id',$district_id)->pluck('id');

        $post=LocalCircular::whereIn('local_id',$local_id)->whereYear('created_at',$year)->whereMonth('created_at',$month)->get();

        return view('area.circular.local',compact('post','year','month'));
    }


    public function localPost(Request $request)
    {
        $month=$request['month'];
        $year=$request['year'];
        $area_id=Auth::user()->area_id;
        
        $district_id=District::where('area_id',$area_id)->pluck('id');

        $local_id= Locals::whereIn('district_id',$district_id)->pluck('id');

        $post=LocalCircular::whereIn('local_id',$local_id)->whereYear('created_at',$year)->whereMonth('created_at',$month)->get();

        return view('area.circular.local',compact('post','year','month'));
    }


    
    public function district()
    {
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;
        $area_id=Auth::user()->area_id;
        
        $district_id=District::where('area_id',$area_id)->pluck('id');

        $post=DistrictCircular::whereIn('district_id',$district_id)->whereYear('created_at',$year)->whereMonth('created_at',$month)->get();

        return view('area.circular.district',compact('year','month','post'));

    }

    public function districtPost(Request $request)
    {
        $month=$request['month'];
        $year=$request['year'];
        $area_id=Auth::user()->area_id;
        
        $district_id=District::where('area_id',$area_id)->pluck('id');

        $post=DistrictCircular::whereIn('district_id',$district_id)->whereYear('created_at',$year)->whereMonth('created_at',$month)->get();

        return view('area.circular.district',compact('year','month','post'));

    }


    public function districtshow($id)
    {
        $area_id=Auth::user()->area_id;
        
        $district_id=District::where('area_id',$area_id)->pluck('id');

        $posts=DistrictCircular::where('id',$id)->where('district_id',Auth::user()->district_id)->first();
        
        if($posts==[]){
            return redirect()->route('APCircularGetD')->withError('Area not found by ID ' .$id)->withInput();
        }
        else{
            $post=DistrictCircular::where('id',$id)->where('district_id',Auth::user()->district_id)->get();
         }   
         return view('area.circular.national',compact('post'));
    }


    public function localshow($id)
    {
        $area_id=Auth::user()->area_id;
        $district_id=District::where('area_id',$area_id)->pluck('id');

        $local_id= Locals::whereIn('district_id',$district_id)->pluck('id');

        $posts=LocalCircular::where('id',$id)->where('local_id',Auth::user()->local_id)->first();
        
        if($posts==[]){
            return redirect()->route('APCircularGetL')->withError('Area not found by ID ' .$id)->withInput();
        }
        else{
            $post=LocalCircular::where('id',$id)->where('local_id',Auth::user()->local_id)->get();
         }   
         return view('area.circular.national',compact('post'));
    }
}
