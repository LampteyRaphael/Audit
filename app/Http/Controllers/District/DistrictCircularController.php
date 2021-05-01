<?php

namespace App\Http\Controllers\District;

use App\AreaCircular;
use App\AuditTrail;
use App\District;
use App\DistrictCircular;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DistrictCircularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //showing national circular
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;
        $post=AreaCircular::orderBy('created_at','desc')
            ->whereMonth('created_at',$month)
            ->whereYear('created_at',$year)
            ->orderBy('created_at','desc')->get();

        return view('districts.circular',compact('post','year','month'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
      //showing circular at the district level
        $id=Auth::user()->district_id;
        $month=Carbon::now()->month;
        $year=Carbon::now()->year;

        $post=DistrictCircular::where('district_id',$id)
            ->whereYear('created_at',$year)
            ->whereMonth('created_at',$month)->get();

        return view('districts.localCircular',compact('post','year','month'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //posting district circular
        $input =$request->all();

        if ($file=$request->file('name')){

            $name=time().$file->getClientOriginalName();

            $file->move('DistrictPdf',$name);

            DistrictCircular::create(['name'=>$name,'district_id'=>$input['district_id']]);
        }
        return redirect()->back()->with(['success1'=>'successfully Posted']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $post=DistrictCircular::where('id',$id)->where('district_id',Auth::user()->district_id)->get();

        if ($post==""){
            return  redirect()->back()->with(['success'=>'Cannot find District Circular with'.$id]);
        }

        return  view('districts.showCircular',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $post=AreaCircular::where('id',$id)->get();

        return  view('districts.showCircular',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request, $id)
    {
        $month=$request['month'];
        $year=$request['year'];
        $post=DistrictCircular::where('district_id',Auth::user()->district_id)
            ->whereYear('created_at',$year)
            ->whereMonth('created_at',$month)->get();

        return view('districts.localCircular',compact('post','year','month'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try{
            $district = DistrictCircular::where('id',$id)->where('district_id',Auth::user()->district_id)->firstOrFail();
            if (!empty($district->name)) {
                if (file_exists($district->name)) {
                    unlink(public_path() . $district->name);
                }
            }

            $district->delete();


        }catch (ModelNotFoundException $exception){

            return back()->withError('District not found by ID ' . $id)->withInput();
        }
        return redirect()->back()->with(['success1'=>'Successfully Deleted']);
    }
}
