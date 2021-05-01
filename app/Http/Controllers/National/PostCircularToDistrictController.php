<?php

namespace App\Http\Controllers\National;

use App\AreaLevelCircular;
use App\AuditTrail;
use App\DistrictCircular;
use App\User;
use AppAreaLevelCircular;
use App\Http\Controllers\Controller;
use App\LocalCircular;
use App\PostCircularForDistrictAdmins;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PostCircularToDistrictController extends Controller
{
    
    public function index(){

        $post=PostCircularForDistrictAdmins::orderBy('created_at','desc')->take(10)->get();

        return view('headquarters.region.circulardistrict',compact('post'));
    }

    public function store(Request $request){

        DistrictCircular::create($request->all());

        return redirect()->back()->with(['success1'=>'Successfully Posted Circular']);
    }



    public function district()
    {
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;
        $post=DistrictCircular::whereMonth('created_at',$month)->whereYear('created_at',$year)->get();

        return view('headquarters.region.districtCircular',compact('post','month','year'));

    }

    public function districtPost(Request $request)
    {
        $month=$request['month'];
        $year=$request['year'];
        $post=DistrictCircular::whereMonth('created_at',$month)->whereYear('created_at',$year)->get();
        return view('headquarters.region.districtCircular',compact('post','month','year'));
    }

    public function districtshow($id)
    {
        $post=DistrictCircular::where('id',$id)->get();
        return view('headquarters.region.pdfshow',compact('post'));
    }

//deleting district circular posted
  public  function districtPostD($id)
  {
      try{
          $district=DistrictCircular::where('id',$id)->firstOrFail();
          if (!empty($district->district)) {
              if (file_exists($district->district->name)) {
                  unlink(public_path() . $district->district->name);
              }
          }
          $district->delete();

      }catch (ModelNotFoundException $exception){

          return back()->withError('District not found by ID ' . $id)->withInput();
      }

      return redirect()->back()->with(['success'=>'successfully deleted']);
  }


    public function areaDelete($id)
    {
        try{
            $area=AreaLevelCircular::where('id',$id)->firstOrFail();
            if (!empty($area->area)) {
                if (file_exists($area->area->name)) {
                    unlink(public_path() . $area->name);
                }
            }
            $area->delete();

        }catch (ModelNotFoundException $exception){

            return back()->withError('Area not found by ID ' . $id)->withInput();
        }

        return redirect()->back()->with(['success'=>'successfully deleted']);
    }


    public function localDelete($id)
    {
        try{
            $local=LocalCircular::where('id',$id)->firstOrFail();
            if (!empty($local->local)) {
                if (file_exists($local->name)) {
                    unlink(public_path() . $local->local->name);
                }
            }
            $local->delete();

        }catch (ModelNotFoundException $exception){

            return back()->withError('Local not found by ID ' . $id)->withInput();
        }

        return redirect()->back()->with(['success'=>'successfully deleted']);

    }


    public function area()
    {
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;
        $post=AreaLevelCircular::whereMonth('created_at',$month)->whereYear('created_at',$year)->get();

        return view('headquarters.region.areaCircular',compact('post','month','year'));
    }

    public function areaPost(Request $request)
    {
        $month=$request['month'];
        $year=$request['year'];
        $post=AreaLevelCircular::whereMonth('created_at',$month)->whereYear('created_at',$year)->get();
        return view('headquarters.region.areaCircular',compact('post','month','year'));
    }

    public function areashow($id)
    {
        $post=AreaLevelCircular::where('id',$id)->get();
        return view('headquarters.region.pdfshow',compact('post'));
    }


    public function locals()
    {
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;
        $post=LocalCircular::whereMonth('created_at',$month)->whereYear('created_at',$year)->get();

        return view('headquarters.region.localCircular',compact('post','month','year'));
    }

    public function localsPost(Request $request)
    {
        $month=$request['month'];
        $year=$request['year'];
        $post=LocalCircular::whereMonth('created_at',$month)->whereYear('created_at',$year)->get();
        return view('headquarters.region.localCircular',compact('post','month','year'));
    }

    public function localsshow($id)
    {
        $post=LocalCircular::where('id',$id)->get();
        return view('headquarters.region.pdfshow',compact('post'));
    }



}
